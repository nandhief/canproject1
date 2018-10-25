<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'reset_link' => urldecode(url('password/reset', $this->token . '?email=' . $this->user->email)),
        ];
        return $this->from('no-reply@bprmaa.com', 'BPR MAA MOBILE')
                    ->subject('Reset password akun BPR MAA MOBILE')
                    ->markdown('mails.reset', compact('data'));
    }
}
