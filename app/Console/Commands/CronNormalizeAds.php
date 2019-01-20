<?php

namespace App\Console\Commands;

use App\Ad;
use App\Mail\EmailNormalizedAds;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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

        \Log::info($ids);

        $ad = Ad::whereRaw("id in " . $ids)->update(['deleted'=>1]);

        if ($ad){

            Mail::to('nirajbjk@gmail.com')
            ->send(new EmailNormalizedAds($ads));

            \Log::Info('Expired ads converted to inactive ads.');
        }
        
    }

    private function expiredAds(){
        return Ad::where('expires','<',now())
        ->where('deleted',0)
        ->get()
        ->toArray();

    }
}
