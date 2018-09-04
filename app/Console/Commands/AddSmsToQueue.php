<?php

namespace App\Console\Commands;

use App\Jobs\SendSms;
use App\SmsQueue;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddSmsToQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addSmsToQueue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sms = SmsQueue::where('sent', false)->get();
        $users = User::All();

        if (!$sms->count()) {
            $this->info('Not Found');
            return ;
        }

        foreach ($users as $user) {
            foreach ($sms as $item) {
                if ($item->time <= Carbon::now()) {
                    SendSms::dispatch($item->message, $user->phone);
                    $this->info('job added in queue');
                    $item->sent = true;
                    $item->save();
                }
            }
        }


    }
}
