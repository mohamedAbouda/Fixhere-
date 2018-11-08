<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RequestSchedule;

class SendScheduledRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendScheduledRequests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Schedule Request';

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
        $sh = RequestSchedule::where('id',4)->first();
        $update = RequestSchedule::where('id',4)->update(['sent_times'=>$sh->sent_times= $sh->sent_times+1]);
    }
}
