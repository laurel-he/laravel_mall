<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    //
    
    public function login(Request $request) 
    {
        
        if (Auth::attempt(['account'=>$request->input('account'), 'password'=>$request->input('password')])) {
            $user = Auth::user();
            $user->roles = $user->roles()->withoutGlobalScope('hide')->get();
//             Log::debug('[sp]',['分隔符===================================================']);
//             $user->roles;
            return $this->success($user, '登录成功');
        } else {
            return $this->error(null, '账号或密码错误');
        }
    }
    
    public function out(Request $request) 
    {
        Auth::logout();
        return $this->success(null, '退出成功');
    }
}
