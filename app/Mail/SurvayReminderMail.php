<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SurvayReminderMail extends Mailable
{
    use Queueable, SerializesModels;


    //public $resetLink;
    // public $surveyLink;
    public $survey;

    /**
     * Create a new message instance.
     */
    public function __construct( $survey)
    {
        // $this->surveyLink  = $surveyLink;
        $this->$survey = $survey;
       // $this->resetLink = $resetLink;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address(Auth::user()->email, Auth::user()->name),
            subject: 'Survay Reminder Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.survayReminder',
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
