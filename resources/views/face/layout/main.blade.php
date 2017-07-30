<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>laravel for blog</title>
    <!-- Bootstrap core CSS -->
    <link href="{{MyStyle}}/bootstrap337/css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="{{MyStyle}}/css/blog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{MyStyle}}/css/wangEditor.min.css">
    {{--<link href="{{MyStyle}}/layui/css/layui.css" rel="stylesheet">--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

@include('face.layout.nav')


<div class="container">

    <div class="blog-header"></div>

    <div class="row">

        @yield('content')


        @include('face.layout.left')
    </div><!-- /.row -->


</div><!-- /.container -->

@include('face.layout.footer')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{MyStyle}}/layui/jquery-3.1.1.js"></script>
<script src="{{MyStyle}}/bootstrap337/js/bootstrap.js"></script>
<script src="{{MyStyle}}/js/ylaravel.js"></script>
<script src="{{MyStyle}}/layui/layui.js"></script>
<script type="text/javascript" src="{{MyStyle}}/js/MyLayer.js"></script>
@yield('js')

</body>
</html>
