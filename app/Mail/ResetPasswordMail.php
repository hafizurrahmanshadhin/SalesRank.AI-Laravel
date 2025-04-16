<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable {
    use Queueable, SerializesModels;

    public string $resetLink;

    /**
     * Create a new message instance.
     */
    public function __construct(string $resetLink) {
        $this->resetLink = $resetLink;
    }

    /**
     * Build the message.
     */
    public function build() {
        return $this
            ->subject('Your Password Reset Link')
            ->view('emails.reset_password');
    }
}
