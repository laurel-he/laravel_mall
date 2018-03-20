<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CustomerInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return [
            'items'=>[
                [
                    'name'=> '张三',
                        'type'=> 'C.一般客户',
                        'realname'=> '本.拉登',
                        'lock_name'=> '小布什',
                        'qq'=> 1008611,
                        'qq_nickname'=> '移动客户',
                        'phone'=> 13666666666,
                        'weixin_nickname'=> '联通客户',
                        'dis_time'=> '2017-11-12 00=>00=>00',
                        'recommend'=> '是',
                        'important'=> '否',
                        'last_track'=> '2017-11-11 10=>37=>50',
                       'share_benefit'=> '3/7',
                        'plan'=> '2017-11-22 14=>08=>05',
                        'conflict'=> '2017-11-22 14=>08=>05',
                        'province_name'=> '旧金山',
                        'sex'=> '女'
                ]
            ],
            'items1'=>[
                [
                        'user'=> '推广A部-王姣姣',
                        'type'=> 'C.一般客户',
                        'name'=> '44N4D',
                        'content'=> '手机号冲突=>15642104241',
                        'created_at'=> '2017-11-22 14=>55=>36',
                        'track_text'=> '预查冲突'
                ]
            ],
            'items2'=>[
                [
                        'user'=> 'KFC-CFK',
                        'content'=> '这个鸡腿太好吃了',
                        'created_at'=> '2017-09-29 12=>28=>07',
                        'type_text'=> '味道问题'
                ]
            ],
            'total'=>400
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
