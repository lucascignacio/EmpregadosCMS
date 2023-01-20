<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details = [])
    {
        $this->details = $details;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    public function build()
    {
        return $this->subject('Mail from ABC Compnay')->view('admin.email.sendmail')
        ->attach($this->details['file']->getRealPath(),
        [
            'as'=>$this->details['file']->getClientOriginalName(),
            'mime'=>$this->details['file']->getClientMimeType(),
        ]);
    }
}
