<?php

namespace App\Mail;

use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Auth;

class SurvayInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $surveyLink;
    public $survey;
    // public Survey $survay;

    /**
     * Create a new message instance.
     */
    public function __construct($surveyLink, $survey)
    {
        $this->surveyLink  = $surveyLink;
        $this->survey = $survey;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Auth::user()->email, Auth::user()->name),
            subject: 'Survay Invitation Mail',

        );
    }

    // public function build()
    // {
    //     return $this->markdown('emails.survayInvitation')->with([
    //         'resetLink' => $this->resetLink,
    //     ]);
    // }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.survayInvitation',
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
