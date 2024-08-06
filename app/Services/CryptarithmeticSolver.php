<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CryptarithmeticSolver
{
    private $iterations = 0;
    private $solutions = [];
    private $letters = ['H', 'I', 'E', 'R', 'G', 'B', 'T', 'S', 'N', 'U'];

    public function solveChunk($start, $end)
    {
        Log::info("Starting to solve chunk from $start to $end");
        $this->backtrack(0, [], $start, $end);
        Log::info("Finished solving chunk. Found " . count($this->solutions) . " solutions");
        return $this->solutions;
    }

    private function backtrack($index, $assignment, $start, $end)
    {
        if ($index == 10) {
            if ($this->isValid($assignment)) {
                Log::info("Found valid solution: " . json_encode($assignment));
                $this->solutions[] = $assignment;
            }
            return;
        }

        $letter = $this->letters[$index];
        $startDigit = ($letter == 'H' || $letter == 'G' || $letter == 'N') ? max(1, $start) : $start;
        $endDigit = min(9, $end);

        for ($digit = $startDigit; $digit <= $endDigit; $digit++) {
            if (!in_array($digit, $assignment)) {
                $assignment[$letter] = $digit;
                $this->backtrack($index + 1, $assignment, 0, 9);
                unset($assignment[$letter]);
            }
            $this->iterations++;
        }
    }

    private function isValid($assignment)
    {
        // ... (keep the existing isValid method)
    }

    public function getIterations()
    {
        return $this->iterations;
    }
}