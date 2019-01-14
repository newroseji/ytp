<?php

namespace App\Console\Commands;

use App\Ad;
use Illuminate\Console\Command;

class CronNormalizeAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'normalize:ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert ad status from active to inactive for all those which are expired.';

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
        $ads = array_column($this->expiredAds(),'id');

        //\Log::info($ads);

        $ids = "('" . implode("','" ,$ads) . "')";


        //\Log::info($ids);

        $ad = Ad::whereRaw("id in " . $ids)->update(['active'=>0]);

        


        //\Log::info($ad);

        \Log::Info('Expired ads converted to inactive ads.');
    }

    private function expiredAds(){
        return Ad::where('expires','<',now())
        ->where('active',1)
        ->get()
        ->toArray();

    }
}
