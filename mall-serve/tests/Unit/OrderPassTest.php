<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\models\OrderBasic;
use App\Events\OrderPass;
use App\Models\User;

class OrderPassTest extends TestCase
{
//     use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
//     public function testExample()
//     {
//         $this->assertTrue(true);
//     }

    public function testPass() 
    {
        event(new OrderPass(OrderBasic::find(7), User::find(13)));
        
        $this->assertDatabaseHas('user_basic', [
            ['id', '=',1],
            ['deposit_money', '=', 64.00],
        ]);
    }
}
