<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $url;
    public $action;
    public $studentName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $content, $url, $action, $studentName)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->url = $url;
        $this->action = $action;
        $this->studentName = $studentName;
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
                'content' => $this->content,
                'url' => $this->url,
                'action' => $this->action,
                'user' => $this->studentName
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
