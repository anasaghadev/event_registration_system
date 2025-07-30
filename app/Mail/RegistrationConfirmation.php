<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $attendee;
    public $qrCodePath;
    /**
     * Create a new message instance.
     */
    public function __construct($attendee)
    {
        $this->attendee = $attendee;
        $this->qrCodePath = asset('storage/qrcodes/' . $attendee->qr_code_path);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تأكيد التسجيل في الفعالية',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // return new Content(
        //     view: 'view.name',
        // );
        return new Content(
            view: 'emails.registration',
            with: [
                'name' => $this->attendee->name,
                // Pass the absolute path to the view
                'qrCodePath' => $this->qrCodePath
            ]
        );

        // return $this->subject('تأكيد التسجيل في الفعالية')
        //     ->view('emails.registration', [
        //         'attendee' => $this->attendee
        //     ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        return [
            // Downloadable attachment
            Attachment::fromPath($this->qrCodePath)
                ->as('رمز-الفعالية.png')
                ->withMime('image/png')
        ];
    }
}
