<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $verificationCode;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $verificationCode)
    {
        $this->email = $email;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Email yuborish
        Mail::raw("Your verification code is: {$this->verificationCode}", function ($message) {
            $message->to($this->email)->subject('Verification Code');
        });
    }
}