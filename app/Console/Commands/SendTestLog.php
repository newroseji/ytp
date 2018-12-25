<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendTestLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test_log:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a test log every 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info("This is a test log generated at " . date('m/d/Y h:i:s'));
    }
}
