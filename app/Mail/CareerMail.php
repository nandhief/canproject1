<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CareerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $career;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($career)
    {
        $this->career = $career;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'name' => $this->career->name,
            'email' => $this->career->email,
            'reply' => $this->career->reply,
        ];
        return $this->from('no-reply@bprmaa.com', 'BPR MAA KARIR')
                    ->view('mails.careers', compact('data'));
    }
}
