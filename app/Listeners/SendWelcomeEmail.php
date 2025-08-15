<?php
namespace App\Listeners;

use App\Events\Registered;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
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
    public function handle(Registered $event): void
    {
        // Log::info("event is: ", ["event"=> $event]);
        try {
            // Log::info("SendWelcomeEmail Listeners!");
            Mail::to($event->user->email)->send(new WelcomeMail($event->user));
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
    }
}
