<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantMail extends Mailable
{
    use Queueable, SerializesModels;
    public $part;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($part)
    {
        //
        $this->part = $part;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.email_verification_mail')->with([
            'participant' => $this->part
        ]);
    }
}
