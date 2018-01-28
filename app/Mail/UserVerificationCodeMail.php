<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $level = 'info';
    public $introLines = [];
    public $outroLines = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->introLines[] = "This is your new verification code : \"$user->verification_code\"";
        $this->introLines[] = "Please use it as soon as possible.";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.notifications.email');
    }
}
