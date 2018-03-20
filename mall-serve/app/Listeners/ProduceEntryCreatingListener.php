<?php
namespace App\Listeners;

use App\Events\ProduceEntryCreating;
use App\Models\ProduceEntry;
use App\Alg\Sn;
use Illuminate\Support\Facades\Log;

class ProduceEntryCreatingListener
{
    
    /**
     * Handle the event.
     *
     * @param  SetCustomerUser  $event
     * @return void
     */
    public function handle(ProduceEntryCreating $event)
    {
        $data = $event->getProduceEntry();
        
        if (empty($data->entry_sn)) {
            $data->entry_sn = Sn::getInSn($data->entrepot_id, ProduceEntry::getAllCount($data->entrepot_id));
        }
        return true;
    }
}