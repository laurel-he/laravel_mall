<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PersonController extends CommonController
{
    //
    /*--------------修改个人资料页面--------------*/
    public function index(){
        $user=new User();
        $arr=$user->getUser();
        return view('home/person/index',['bar'=>static::$bar,'user'=>$arr[0]]);
    }
    /*--------------我的地址--------------*/
    public function address(){
        return view('home/person/address',['bar'=>static::$bar]);
    }
    /*--------------我的收藏--------------*/
    public function collection(){
        return view('home/person/collection',['bar'=>static::$bar]);
    }
    /*--------------订单详情--------------*/
    public function orderDetails(){
        return view('home/person/orderDetails',['bar'=>static::$bar]);
    }
    /*--------------订单管理--------------*/
    public function orderManage(){
        return view('home/person/orderManage',['bar'=>static::$bar]);
    }
    /*--------------修改密码页面--------------*/
    public function password(){
        return view('home/person/password',['bar'=>static::$bar]);
    }
    /*--------------修改密码动作--------------*/
    public function password_do(Request $request){
        if($request->isMethod('post')){
            $users=new User();
            $arr=$users->passwordChange($_POST);
            return $arr;
        }else{
            return '非post提交';
        }
    }
    /*--------------修改个人资料动作--------------*/
    public function personChange(Request $request){
        if($request->isMethod('post')){
            $arr=array();
            $user=new User();
            if(isset($_POST['nick_name'])){
                $arr['nick_name']=$_POST['nick_name'];
            }
            if(isset($_POST['qq'])){
                $arr['qq']=$_POST['qq'];
            }
            if(isset($_POST['real_name'])){
                $arr['real_name']=$_POST['real_name'];
            }
            if(isset($_POST['wechart'])){
                $arr['wechart']=$_POST['wechart'];
            }
            if(isset($_POST['upload'])){
                $file=$request->file('myfile');
                //获取文件相关信息
                $name=$file->getClientOriginalName();
                $ext=$file->getClientOriginalExtension();
                $realPath=$file->getRealPath();
                $type=$file->getClientMimeType();
                $size=$file->getClientSize();
                //上传文件
                $filename=MD5(time()) .'.'. $ext;
                //使用我们新建的upload本地存储空间
                $bool=Storage::disk('upload')->put(date('Ymd').'/'.$filename,file_get_contents($realPath));
                $arr['head_img']='../upload/'.date('Ymd').'/'.$filename;
            }
            $as=$user->personChange($arr);
            return $as;
        }else{
            return '非POST提交';
        }
    }
}
