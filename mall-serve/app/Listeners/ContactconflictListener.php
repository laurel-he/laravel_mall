<?php

namespace App\Listeners;

use App\Events\ContactConflict;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\CustomerContact;
use App\Models\CustomerUser;

class ContactconflictListener
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
     * @param  ContactConflict  $event
     * @return void
     */
    public function handle(ContactConflict $event)
    {
        $message = $event->getMessage();
        $contact = $event->getContact();
        
       
        
        if (isset($message['phone'])) {
            $contactModel = CustomerContact::where('phone', $contact['phone'])->select('cus_id')->first();
        } else if(isset($message['qq'])) {
            $contactModel = CustomerContact::where('qq', $contact['qq'])->select('cus_id')->first();
        } else if(isset($message['weixin'])) {
            $contactModel = CustomerContact::where('weixin', $contact['weixin'])->select('cus_id')->first();
        }

        $customerUserModel = CustomerUser::where('cus_id', $contactModel->cus_id)->first();
        $customerUserModel->setConflict();
        $customerUserModel->save();
    }
}
