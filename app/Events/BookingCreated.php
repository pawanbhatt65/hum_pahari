<?php
namespace App\Events;

use App\Models\UserRegister;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UserRegister $booking;
    public $homestay;
    public $seller; // seller user instance (Auth::user() per your request)

    /**
     * Create a new event instance.
     */
    public function __construct(UserRegister $booking, $homestay, $seller)
    {
        $this->booking  = $booking;
        $this->homestay = $homestay;
        $this->seller   = $seller;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
