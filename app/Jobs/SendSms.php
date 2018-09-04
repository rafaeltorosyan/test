<?php

namespace App\Jobs;

use App\Services\DbLog;
use App\Services\TwilioApi;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $phone)
    {
        $this->message = $message;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = TwilioApi::sendSms($this->message, $this->phone);

        if ($result) {
            DbLog::info('sms send');
        } else {
            DbLog::error('sms sending error. phone: '.$this->phone);
        }
    }
}
