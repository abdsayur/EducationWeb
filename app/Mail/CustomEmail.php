<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageText;
    public $attachmentPath;

    /**
     * Create a new message instance.
     */
    public function __construct($subjectText, $messageText, $attachmentPath = null)
    {
        $this->subjectText = $subjectText;
        $this->messageText = $messageText;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Custom Email',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.custom',
    //     );
    // }

    public function build()
    {
        $email = $this->subject($this->subjectText)
            ->markdown('emails.custom')
            ->with([
                'messageText' => $this->messageText,
            ]);

        if ($this->attachmentPath) {
            $email->attachFromStorageDisk('email-attachment', $this->attachmentPath);
        }

        return $email;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
