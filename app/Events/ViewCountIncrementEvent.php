<?php

namespace App\Events;

use App\Models\Link;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ViewCountIncrementEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }


    public function broadcastOn()
    {
        return [];
    }
}
