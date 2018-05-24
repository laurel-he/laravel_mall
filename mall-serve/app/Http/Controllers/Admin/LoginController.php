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
            if($user->status == '-1'){
                return $this->error(null, '此账号已被禁用');
            }
            $user->roles = $user->roles()->withoutGlobalScope('hide')->get();
            $user->department = $user->department()->get();
            $user->group = $user->group()->get();
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
        $request->session()->invalidate();
        return $this->success(null, '退出成功');
    }
}
