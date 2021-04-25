<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefreshBallotList implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    //REFRESH THE BALLOT LISTS IF COMELEC ROLE == COMELEC ROLE OF THE LOGGED IN USER
    public $comelec_role;
    public $ballot_id;
    public $barcoded_receiver;
    public $statusType;
    public $userName;
    
    /**
    * Create a new event instance.
    *
    * @return void
    */
    public function __construct($comelec_role, $ballot_id, $barcoded_receiver, $statusType, $userName)
    {
        $this->comelec_role = $comelec_role;
        $this->ballot_id = $ballot_id;
        $this->barcoded_receiver = $barcoded_receiver;
        $this->statusType = $statusType;
        $this->userName = $userName;
    }
    
    /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\Channel|array
    */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return new Channel('RefreshBallotListChannel');
    }
}
