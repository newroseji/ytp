<?php

namespace App\Console;

use App\Cron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //'App\Console\Commands\SendTestLog',
        //'App\Console\Commands\SendTestEmail',
        'App\Console\Commands\CronTest',
        'App\Console\Commands\CronPurgeAds',
        'App\Console\Commands\CronNormalizeAds',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('purge:ads')
                  ->everyTenMinutes();

        /*
        $schedule->command('test_log:create')
                  ->everyFiveMinutes();

        $schedule->command('email:send')
                  ->everyTenMinutes(); 
        */

        $schedule->command('command:test')->everyMinute()->when(function () {
                    return Cron::shouldIRun('command:test', 10); //returns true every 10 minutes
        });

        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
