<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $verification_code;

    public $level = 'info';
    public $introLines = [];
    public $outroLines = [];
    public $actionText;
    public $actionUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->name = $user->full_name;
        $this->email = $user->email;
        $this->verification_code = $user->verification_code;
        $this->introLines[] = "Welcome to E7gz Kora.";
        $this->introLines[] = "You've signed up successfully.";
        $this->actionUrl = route('verify',$this->verification_code);
        $this->actionText = "Verify";
        // $this->introLines[] = "Please use it as soon as possible.";
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
