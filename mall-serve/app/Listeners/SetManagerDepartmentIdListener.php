<?php

namespace App\Listeners;

use App\Events\AddDepartment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class SetManagerDepartmentIdListener
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
     * @todo 更新失败 未处理
     * 
     * @param  AddDepartment  $event
     * @return void
     */
    public function handle($event)
    {
        $depart_id = $event->getDepartmentId();
        $user_id = $event->getUserId();
        
        // 这个update 是 model update  还是 builder update
        $re = User::where('id', $user_id)->update(['department_id'=>$depart_id]);
//         if ($re == 0) {
//         	throw new \Error('更新失败');
//         }
    }
}
