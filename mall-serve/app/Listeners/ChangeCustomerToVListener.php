<?php

namespace App\Listeners;

use App\Events\AddOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeCustomerToVListener
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
     * @param  AddOrder  $event
     * @return void
     */
    public function handle(AddOrder $event)
    {
        $order = $event->getOrder();
        $user = $order->customer;
        $user->setV();
        $user->save();
    }
}
