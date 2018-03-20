<html>
    <head>
        <title>应用程序名称 - @yield('title',"父标题")</title>
    </head>
    <body>
    		<h1>1111</h1>
    		<h2>2222</h2>
    		<h3>3333</h3>
        @section('sidebar')
            这是 master 的侧边栏。
        @show

        <div class="container">
        		<h4>4444</h4>
            @yield('content',"这个是yield")
        </div>
    </body>
</html>