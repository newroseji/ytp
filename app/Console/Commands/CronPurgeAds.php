<?php

namespace App\Console\Commands;

use App\Ad;
use App\Mail\EmailPurged;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CronPurgeAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'purge:ads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge all ads that are set to delete (which are marked soft delete)';

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
        $deleted_ads= $this->deletedAds();

        if(count($deleted_ads)>0){

            $purged = Ad::where('deleted',1)->delete();

            //\Log::info($purged);

            
            Mail::to('nirajbjk@gmail.com')->send(new EmailPurged($deleted_ads));
            
            \Log::info(count($deleted_ads) . " ads deleted at " . date('m/d/Y h:i:s'));
        }

    }

    private function deletedAds(){
        return Ad::where('deleted',1)->get();

    }
}
