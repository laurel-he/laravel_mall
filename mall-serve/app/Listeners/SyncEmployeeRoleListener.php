<?php
namespace App\Listeners;

use App\Events\AddEmployee;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class SyncEmployeeRoleListener
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
     * @param AddEmployee $event            
     * @return void
     */
    public function handle(AddEmployee $event)
    {
        $user = $event->getUser();
        $roleId = $event->getRoleIds();
        
        if (empty($roleId)) {
            return;
        }
        
        if (!is_array($roleId)) {
        	$roleId = [$roleId];
        }
        
        $roles = Role::find($roleId);
        
        $hideRoles = [];
        foreach ($roles as $role) {
        	$relative = Role::getRelative($role->name);
        	if ($relative) {
        		$hideRoles = array_merge($hideRoles, $relative);
        	}
        }
        
//         $hideRoleIds = [];
        foreach ($hideRoles as $value){
        	$roleId[] = Role::withoutGlobalScope('hide')->where('name', $value)->value('id');
        }
        
        Log::info('[event] attach employee hideRoles Role', $roleId);
        //以防万一
        if ($roleId) {
        	
        	$user->roles()->sync(array_values($roleId));
        }
    }
}
