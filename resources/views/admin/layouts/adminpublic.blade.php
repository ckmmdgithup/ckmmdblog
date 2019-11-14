<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="{{asset('/admin//favicon.ico')}}" >
<link rel="Shortcut Icon" href="{{asset('admin//favicon.ico')}}" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('/admin/lib/html5shiv.js')}}"></script>
<script type="text/javascript" src="{{asset('/admin/lib/respond.min.js')}}"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('/admin/static/h-ui.admin/css/style.css')}}" />


    @section('style')
{{--        //this is style--}}
    @show

<!--[if IE 6]>
<script type="text/javascript" src="{{asset('/admin/lib/DD_belatedPNG_0.0.8a-min.js')}}" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <title>ckmmd-@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
</head>
<body>
    @section('nav')
{{--    //this is main nav--}}
    @show




    @section('main')
{{--            //this is main content--}}
    @show




    <script type="text/javascript" src="{{asset('/admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/layer/2.4/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/static/h-ui/js/H-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
    <script>
        function passupdate() {

            var chage_password = layer.open({
                type: 2,
                title: '修改密码',
                area:['350px','450px'],
                content:'{{url('admin/change_password')}}',
            });

        }
        
        
    </script>
    @section('script')
{{--        //this is script--}}
    @show
</body>
</html>