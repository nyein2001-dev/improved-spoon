<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $template;
    public $subject;
    public $verification_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriber, $template, $subject, $verification_link)
    {
        $this->subscriber = $subscriber;
        $this->template = $template;
        $this->subject = $subject;
        $this->verification_link = $verification_link;
    }

    public function build()
    {
        $subscriber = $this->subscriber;
        $template = $this->template;
        $verification_link = $this->verification_link;
        return $this->subject($this->subject)->view('subscription_verification_email', compact('subscriber', 'template', 'verification_link'));
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Subscription Verification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
