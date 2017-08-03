@extends('admin.layout.main')

@section('content')

        <p class="f-20 text-success">欢迎使用H-ui.admin
            <span class="f-14">v2.3</span>
            后台模版！</p>
        <p>登录次数：18 </p>
        <p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
        <table class="table table-border table-bordered table-bg mt-20">
            <thead>
            <tr>
                <th colspan="2" scope="col">服务器信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th width="30%">服务器计算机名</th>
                <td><span id="lbServerName">{{$_SERVER['HTTP_HOST']}}</span></td>
            </tr>
            <tr>
                <td>服务器IP地址</td>
                <td>{{$_SERVER['SERVER_NAME']}}</td>
            </tr>
            <tr>
                <td>服务器域名</td>
                <td>{{$_SERVER['HTTP_REFERER']}}</td>
            </tr>
            <tr>
                <td>服务器端口 </td>
                <td>{{$_SERVER['SERVER_PORT']}}</td>
            </tr>
            <tr>
                <td>服务器版本 </td>
                <td>{{$_SERVER['SERVER_SOFTWARE']}}</td>
            </tr>
            <tr>
                <td>本文件所在文件夹 </td>
                <td>{{$_SERVER['DOCUMENT_ROOT']}}</td>
            </tr>


            <tr>
                <td>服务器当前时间 </td>
                <td>{{date('Y-m-d H:i:s')}}</td>
            </tr>


            <tr>
                <td>当前程序占用内存 </td>
                <td>3.29M</td>
            </tr>
            <tr>
                <td>Asp.net所占内存 </td>
                <td>51.46M</td>
            </tr>
            <tr>
                <td>当前Session数量 </td>
                <td>8</td>
            </tr>
            <tr>
                <td>当前SessionID </td>
                <td>gznhpwmp34004345jz2q3l45</td>
            </tr>
            <tr>
                <td>当前系统用户名 </td>
                <td>NETWORK SERVICE</td>
            </tr>
            </tbody>
        </table>
@endsection