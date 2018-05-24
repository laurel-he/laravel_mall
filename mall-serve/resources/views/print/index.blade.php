<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>打印{{ config('app.name', 'Laravel') }}</title>
    <link  rel="stylesheet" href="/css/bootstrap.min.css">
    <style type="text/css">
        body{
            padding: 0 10px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        table {
            width: 100%;
        }
        th {
            width: 100px;
        }
        th,td{
            text-indent: 5px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">快递单据</h1>
<table border="1" cellspacing="0"  >
    <caption class="text-right">编号NO.{{$model->sn}}</caption>
        <tr>
            <th>快递公司</th>
            <td>{{$model->express_name}}</td>
            <th>
                    寄件人
                </th>
                <td>
                    {{$model->user_name}}
                </td>
        </tr>
        <tr>
                <th>快递号</th>
                <td>{{$model->express_sn}}</td>
            <th>
                快递时间
            </th>
            <td>
                {{$model->express_at}}
            </td>
        </tr>
        <tr>
            <th>收货人姓名</th>
            <td>{{$model->deliver_name}}</td>
            <th>
                    联系方式
            </th>
            <td>
                {{$model->deliver_phone}}
            </td>
        </tr>
        
        <tr>
            <th>
                收货地址
            </th>
            <td colspan="3">
                {{$model->deliver_address}}
            </td>
        </tr>
        <tr>
            <th>
                快递清单
            </th>
            <td colspan="3">
               {{$model->goods}}
            </td>
        </tr>
    </table>
    <div class="container-fluid">
        <div class="row">
        	<div class="col-sm-5 col-md-5 col-lg-5 ">打印操作员:{{auth()->user()->realname}}</div>
        	<div class="col-sm-5 col-md-5 col-lg-5 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 text-right">打印时间:{{ Date('Y-m-d H:i:s') }}</div>
        </div>
    </div>
    
	<script>
		window.print();
	</script>
</body>
</html>