<?php
namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingSellerMail;
use App\Mail\BookingUserMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingEmails
{

    // Use queue for non-blocking email sending. Make sure queue worker is configured.
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        $booking  = $event->booking;
        $homestay = $event->homestay;
        $seller   = $event->seller;

        // Send to registered user (booking guest)
        if (! empty($booking->email)) {
            Mail::to($booking->email)
                ->send(new BookingUserMail($booking, $homestay, $seller));
        }

        // Send to seller (we assume $seller has 'email' attribute)
        if ($seller && ! empty($seller->email)) {
            Mail::to($seller->email)
                ->send(new BookingSellerMail($booking, $homestay, $seller));
        }
    }
}
