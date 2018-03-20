@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">后台首页</div>
                    <div class="panel-body">
                        <a href="{{URL('admin/pages/create')}}" class="btn btn-lg btn-primary">新增</a>
                        @foreach($pages as $page)
                            <hr>
                            <div class="page">
                                <h4>{{$page->title}}</h4>
                                <div class="content">
                                    <p>
                                        {{$page->body}}
                                    </p>
                                </div>
                            </div>
                            <a href="{{URL('admin/pages/'.$page->id.'/edit')}}" class="btn brn-success">编辑</a>
                            <form action="{{URL('admin/pages/'.$page->id)}}" style="display: inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection