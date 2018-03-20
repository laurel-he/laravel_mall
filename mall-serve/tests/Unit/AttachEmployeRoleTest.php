<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Events\AddEmployee;

/**
 * 测试 添加员工时 的角色处理事件
 * 没搞懂测试怎么用的。
 * @author hyf
 *
 */
class AttachEmployeRoleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
//         ech 'aaa';
//         $this->assertTrue(true);
            $user = User::find(1);
            $user->role_id = 4;
            event(new AddEmployee($user));
            /* 
             *  [ 'user_id' => 1, 'role_id' =>7 ],
                [ 'user_id' => 1, 'role_id' =>9 ] */
            $this->assertDatabaseHas('role_user', [ 
                ['user_id', 1],
                ['role_id', 6] 
            ]);
            
            $this->assertDatabaseHas('role_user', [
                ['user_id', 1],
                ['role_id', 7]
            ]);
            
            $this->assertDatabaseHas('role_user', [
                ['user_id', 1],
                ['role_id', 9]
            ]);
    }
}
