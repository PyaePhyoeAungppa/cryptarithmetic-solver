<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use App\Jobs\SolvePuzzleChunkJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class SolutionController extends Controller
{
    public function index()
    {
        $solutions = Solution::paginate(20);
        $batchId = session('batchId');
        $batch = $batchId ? Bus::findBatch($batchId) : null;

        Log::info("Accessed solutions index page. BatchId: " . ($batchId ?? 'None'));

        return view('solutions.index', compact('solutions', 'batch'));
    }

    public function solve()
    {
        Log::info("Starting to solve puzzle");

        $chunks = 9; // Divide the problem into 9 chunks
        $jobs = [];

        for ($i = 0; $i < $chunks; $i++) {
            $start = $i;
            $end = $i + 1;
            $jobs[] = new SolvePuzzleChunkJob($start, $end);
        }

        $batch = Bus::batch($jobs)->dispatch();

        Log::info("Dispatched batch job with ID: " . $batch->id);

        session(['batchId' => $batch->id]);

        return redirect()->route('solutions.index')->with('message', 'Puzzle solving jobs have been queued.');
    }
}