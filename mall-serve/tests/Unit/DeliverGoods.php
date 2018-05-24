<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\Inventory;
use App\Models\Assign;

class DeliverGoods extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//     public function testExample()
//     {
//         $this->assertTrue(true);
//     }

    public function testDeliverGoods()
    {
        $invent = new Inventory();
        $assign = Assign::find(3);
//         logger("[debug]", $assign->toArray());
        $invent->orderAssigned($assign->entrepot_id, $assign);
        
        $this->assertDatabaseHas('inventory_system', [
            ['sku_sn','arg'],
            ['send_ing',1]
        ]);
    }
}
