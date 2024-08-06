<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Bus;

class SolvePuzzleJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $chunks = 9; // Divide the problem into 9 chunks
        $jobs = [];

        for ($i = 0; $i < $chunks; $i++) {
            $start = $i;
            $end = $i + 1;
            $jobs[] = new SolvePuzzleChunkJob($start, $end);
        }

        Bus::batch($jobs)->dispatch();
    }
}