<!-- resources/views/solutions/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptarithmetic Solver</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Cryptarithmetic Solver</h1>
        
        @if(session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <form action="{{ route('solutions.solve') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Solve Puzzle
            </button>
        </form>

        @if($batch)
            <div class="mb-4">
                <h2 class="text-xl font-bold">Batch Progress</h2>
                <p>Progress: {{ $batch->progress() }}%</p>
                <p>Total Jobs: {{ $batch->totalJobs }}</p>
                <p>Processed Jobs: {{ $batch->processedJobs() }}</p>
                <p>Pending Jobs: {{ $batch->pendingJobs }}</p>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-2">Solutions:</h2>
        
        @if($solutions->isEmpty())
            <p>No solutions found yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($solutions as $solution)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <p><strong>H:</strong> {{ $solution->h }}</p>
                        <p><strong>I:</strong> {{ $solution->i }}</p>
                        <p><strong>E:</strong> {{ $solution->e }}</p>
                        <p><strong>R:</strong> {{ $solution->r }}</p>
                        <p><strong>G:</strong> {{ $solution->g }}</p>
                        <p><strong>B:</strong> {{ $solution->b }}</p>
                        <p><strong>T:</strong> {{ $solution->t }}</p>
                        <p><strong>S:</strong> {{ $solution->s }}</p>
                        <p><strong>N:</strong> {{ $solution->n }}</p>
                        <p><strong>U:</strong> {{ $solution->u }}</p>
                        <p><strong>Iterations:</strong> {{ $solution->iterations }}</p>
                    </div>
                @endforeach
            </div>
            {{ $solutions->links() }}
        @endif
    </div>
</body>
</html>