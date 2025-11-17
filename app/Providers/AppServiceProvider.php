<?php
namespace App\Providers;

use App\Events\Registered;
// use Illuminate\Auth\Events\Registered;
use App\Listeners\SendWelcomeEmail;
use App\Mail\BookingSellerMail;
use App\Mail\BookingUserMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            Registered::class,
            SendWelcomeEmail::class,
            BookingUserMail::class,
            BookingSellerMail::class,
        );
    }
}
