<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\ScrapperController;

class ScrapperCommand extends Command
{
    protected $signature = 'scrapper:run';
    protected $description = 'Run the scrapper function every hour';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scrapperController = new ScrapperController();
        $request = new Request(); 
        $scrapperController->scrapper($request); 

        $this->info('Scrapper ran successfully!');
    }
}
