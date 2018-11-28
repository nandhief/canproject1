<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HistoryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $history;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($history)
    {
        $this->history = $history;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'name' => $this->history->name,
            'email' => $this->history->email,
            'category' => $this->history->category,
            'reply' => $this->history->reply,
        ];
        return $this->from('no-reply@bprmaa.com', 'BPR MAA ' . $data['category'])
                    ->view('mails.histories', compact('data'));
    }
}
