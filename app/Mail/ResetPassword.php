<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Auth;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $user;
    // public Survey $survay;

    /**
     * Create a new message instance.
     */
    public function __construct($link, $user)
    {
        $this->link  = $link;
        $this->user = $user;
		
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address(Auth::user()->email, Auth::user()->name),

            subject: 'Reset Password Mail',

        );
    }

    public function build()
    {
        return $this->content();
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resetpassword',
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
