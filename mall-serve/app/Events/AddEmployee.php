<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\User;
/**
 * 名称搞错了 应该用 SetEmployeeRole
 * @author hyf
 *
 */
class AddEmployee
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $role_ids = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $roleIds)
    {
        $this->user = $user;
        $this->role_ids = $roleIds;
    }
    
    public function getUser() 
    {
        return $this->user;
    }
    
    public function getRoleIds()
    {
    	return $this->role_ids;	
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
//     public function broadcastOn()
//     {
//         return new PrivateChannel('channel-name');
//     }
}
