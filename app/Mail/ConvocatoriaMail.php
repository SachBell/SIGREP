<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConvocatoriaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $action;
    public $subject;
    public $content;
    public $url;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $content, $url, $action, $studentName)
    {
        $this->studentName = $studentName;
        $this->subject = $subject;
        $this->content = $content;
        $this->action = $action;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.calls',
            with: [
                'user' => $this->studentName,
                'content' => $this->content,
                'action' => $this->action,
                'url' => $this->url,
            ]
        );
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
