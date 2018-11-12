<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RequestSchedule;
use App\Models\Request as ClientRequest;
use App\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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
        //$update = RequestSchedule::where('id','!=',null)->update(['sent_times'=>4]);
        $requestSchedules = RequestSchedule::whereDate('day_date', \Carbon\Carbon::today())->where('day_time', '<=', \Carbon\Carbon::now()->toTimeString())->with('request.user')->get();
        foreach ($requestSchedules as $requestSchedule) {
            if ($requestSchedule->sent_times <= 3) {
                $requestSchedule->update(['sent_times'=>$requestSchedule->sent_times+1]);
                $tokens = User::where('device_id', '!=', null)->pluck('device_id')->toArray();
                if ($tokens) {
                    $this->sendRequest('New Request', 'New Request hurry up', 'request', $requestSchedule->request_id, $tokens);
                }
            } else {
                $token = $requestSchedule->request->user->device_id;
                if ($token) {
                    $this->sendRequest('Request Deleted', 'No Technical agent applied for your request , please create a new one ', 'request', $requestSchedule->request_id, $token);
                    $requestDelete = ClientRequest::where('id', $requestSchedule->request_id)->delete();
                    $requestSchedule->delete();
                }
            }
        }
    }
    
    public function sendRequest($title, $body, $object_name, $object_id, $tokens)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([$object_name => $object_id]);
        
        
        $option       = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data         = $dataBuilder->build();
        
        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }
}