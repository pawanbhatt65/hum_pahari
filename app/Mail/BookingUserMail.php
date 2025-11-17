<?php
namespace App\Mail;

use App\Models\UserRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public UserRegister $booking;
    public $homestay;
    public $seller;

    /**
     * Create a new message instance.
     */
    public function __construct(UserRegister $booking, $homestay, $seller)
    {
        $this->booking  = $booking;
        $this->homestay = $homestay;
        $this->seller   = $seller;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            subject: 'Your Homestay Booking Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.booking_user',
            with: [
                'booking'  => $this->booking,
                'homestay' => $this->homestay,
                'seller'   => $this->seller,
            ],
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
