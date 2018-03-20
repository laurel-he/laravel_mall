<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\models\OrderBasic;
use App\Http\Controllers\Inventory;

class OrderCancelInventoryTest extends TestCase
{
    //下面这个 其它的数据库迁移都
//     use DatabaseMigrations;
       use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
//     public function testExample()
//     {
//         $this->assertTrue(true);
//     }

    public function testCancel()
    {
        
        $inventorySys = new Inventory();
        $order = OrderBasic::find(11);
        
        $inventorySys->cancelOrder($order->entrepot_id, $order->goods);
        
        $this->assertDatabaseHas('inventory_system', [
            ['sku_sn', '=','efe001'],
            ['saleable_count', '=', 177],
            ['sale_lock','=',3]
        ]);
    }
}
