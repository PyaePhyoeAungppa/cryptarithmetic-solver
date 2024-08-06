# Cryptarithmetic Solver

## Description
This Laravel-based web application solves the cryptarithmetic puzzle "HIER + GIBT + ES = NEUES". It employs a backtracking algorithm to find solutions, utilizing Laravel's job batching feature for efficient processing.

## The Puzzle
The puzzle assigns a unique digit (0-9) to each letter in the equation:

```
HIER + GIBT + ES = NEUES
```

The goal is to find assignments that make the equation true.

## Features
- Solves the "HIER + GIBT + ES = NEUES" cryptarithmetic puzzle
- Uses Laravel's job batching for parallel processing
- Web interface to initiate solving and view results
- Database storage of solutions
- Real-time progress tracking of the solving process

## Requirements
- PHP ^8.1
- Laravel ^10.10
- MySQL or compatible database
- Composer

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/PyaePhyoeAungppa/cryptarithmetic-solver.git
   ```
2. Navigate to the project directory:
   ```bash
   cd cryptarithmetic-solver
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Copy the `.env.example` file to `.env` and configure your database settings.

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations:
   ```bash
   php artisan migrate
   ```

## Usage
1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```
2. In a separate terminal, start the queue worker:
   ```bash
   php artisan queue:work
   ```
3. Open your browser and navigate to `http://localhost:8000`.
4. Click the "Solve Puzzle" button to start the solving process.
5. Refresh the page to see updated results and progress.

## How It Works
1. The application divides the problem space into chunks.
2. Each chunk is processed as a separate job in Laravel's job batching system.
3. The solver uses a backtracking algorithm to find valid solutions within each chunk.
4. Solutions are stored in the database as they are found.
5. The web interface allows tracking of the overall progress and viewing of found solutions.