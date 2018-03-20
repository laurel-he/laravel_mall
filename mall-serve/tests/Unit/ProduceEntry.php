<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\InventorySystem;
use App\Http\Controllers\Inventory;

class ProduceEntry extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     * test  InventorySystem->hasSkuSns
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function testEntryUpdate()
    {
        $inventorySys = new Inventory();
        $inventorySys->produceEntry(1, [['sku_sn'=>'efe001','goods_name'=>'商1','num'=>90]]);
        $inventorySys->produceEntry(2, [['sku_sn'=>'efe001','goods_name'=>'商1','num'=>90]]);
        
        $this->assertDatabaseHas('inventory_system', [
            ['sku_sn', '=','efe001']
        ]);
    }
}
