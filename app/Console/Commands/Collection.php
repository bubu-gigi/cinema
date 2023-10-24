<?php

namespace App\Console\Commands;

use App\Models\Film;
use Illuminate\Console\Command;

class Collection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $films = Film::all();
        foreach($films as $film)
            echo $film->title . "s daily gain is: " . $film->daily_gain . PHP_EOL;
        return "test";
    }
}
