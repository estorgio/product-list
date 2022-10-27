<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class DemoReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset application database and storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:refresh --seed');
        Storage::deleteDirectory('product-images');
        Storage::makeDirectory('product-images');
        Storage::copy('demo/sample-1.jpg', 'product-images/sample-1.jpg');

        return Command::SUCCESS;
    }
}
