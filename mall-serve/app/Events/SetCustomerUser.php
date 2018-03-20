<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class SetCustomerUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	
    private $data = [];
    
    /**
     * Create a new event instance.
     * @todo 把空的字段 设置一下
     * 
     * @return void
     */
    public function __construct(\App\Models\User $user, $cus_id, $type)
    {
    	$this->data['cus_id'] = $cus_id;
    	$this->data['user_id'] = $user->id;
    	$this->data['type'] = empty($type) ? 0 : intval($type);
    	$this->data['group_id'] = $user->group_id;
    	$this->data['department_id'] = $user->department_id;
    	
    	$this->data['user_name'] = $user->realname;
    	
    	$this->data['group_name'] = $user->group ? $user->group->name : '';
    	$this->data['department_name'] = $user->department ? $user->department->name : '';
    		
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
    
    public function getData()
    {
    	return $this->data;
    }
}
