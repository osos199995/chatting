<?php

namespace App\Events;

use App\Messages;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use mysql_xdevapi\SchemaObject;

class NewMessages implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


        public $message;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Messages $message)
    {
        $this->message =$message;


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('messages'.$this->message->to,auth()->user()->id);
    }

    public function broadcastWith()
    {
        $this->message->load('fromContact');
        return ["messages" => $this->message];
    }


}
