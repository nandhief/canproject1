<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
            'url_activation' => $this->user->url_activation,
        ];
        return $this->from('no-reply@bprmaa.com', 'BPR MAA MOBILE')
                    ->subject('Aktivasi akun BPR MAA MOBILE')
                    ->markdown('mails.register', compact('data'));
    }
}
