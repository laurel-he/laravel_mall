@extends("test.base")

@section('title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.1</p>
@stop

@section('sidebar')
   

    <p>This is appended to the master sidebar.2</p>
@append

@section('sidebar')
  

    <p>This is appended to the master sidebar.3</p>
@append

@section('sidebar')
  

    <p>This is appended to the master sidebar.4</p>
@append

@section('content')
		
    dfsdfsdf
@stop