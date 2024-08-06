<?php

namespace App\Jobs;

use App\Services\CryptarithmeticSolver;
use App\Models\Solution;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SolvePuzzleChunkJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function handle()
    {
        Log::info("Starting SolvePuzzleChunkJob for range: {$this->start} to {$this->end}");
        
        $solver = new CryptarithmeticSolver();
        $solutions = $solver->solveChunk($this->start, $this->end);
        $iterations = $solver->getIterations();

        Log::info("Chunk solved. Found " . count($solutions) . " solutions in $iterations iterations");

        foreach ($solutions as $solution) {
            if (is_array($solution) && count($solution) == 10) {
                $savedSolution = Solution::create([
                    'h' => $solution['H'] ?? null,
                    'i' => $solution['I'] ?? null,
                    'e' => $solution['E'] ?? null,
                    'r' => $solution['R'] ?? null,
                    'g' => $solution['G'] ?? null,
                    'b' => $solution['B'] ?? null,
                    't' => $solution['T'] ?? null,
                    's' => $solution['S'] ?? null,
                    'n' => $solution['N'] ?? null,
                    'u' => $solution['U'] ?? null,
                    'iterations' => $iterations
                ]);
                Log::info("Saved solution to database with ID: " . $savedSolution->id);
            }
        }

        Log::info("Finished SolvePuzzleChunkJob for range: {$this->start} to {$this->end}");
    }
}