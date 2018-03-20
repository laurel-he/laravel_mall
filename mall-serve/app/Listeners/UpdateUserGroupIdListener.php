<?php

namespace App\Listeners;

use App\Events\UpdateGroupCaptain;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class UpdateUserGroupIdListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateGroupCaptain  $event
     * @return void
     */
    public function handle(UpdateGroupCaptain $event)
    {
        User::where('id', $event->getUserId())->update(['group_id'=>$event->getGroupId()]);
    }
}
