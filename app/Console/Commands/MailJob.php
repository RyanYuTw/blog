<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;

use App\Models\Mail as MailModel;
use App\Mail\SendMail;

/**
 * 排程信件寄送
 * php artisan MailJob:MailJob
 */
class MailJob extends Command
{
    const MAIL_SEND_SUCCESS = 1;
    const MAIL_SEND_FAIL    = -1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MailJob:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email寄送成功';

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
    public function handle(Request $request)
    {
        $this->info('START');
        $mails = MailModel::where('send_status', 0)->get();

        if ($mails->isNotEmpty()) {
            foreach ($mails as $mail) {
                $mailAddress = env('MAIL_FROM_ADDRESS');
                Mail::to($mailAddress)->send(new SendMail($mail));

                $mail->send_status = self::MAIL_SEND_SUCCESS;
                $mail->save();
            }

            $this->info('Email寄送完成!');
        }

        $this->info('END');
    }
}
