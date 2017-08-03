@extends('admin.layout.main')

@section('title')
    管理员列表
@endsection

@section('content')

    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>


    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="{{url('admin/users/create')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> </span>
        <span class="r">共有数据：<strong>{{$adminUsers->count()}}</strong> 条</span>
    </div>

    @include('admin.layout.error')
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">员工列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">ID</th>
            <th width="150">登录名</th>
            <th width="150">邮箱</th>
            {{--<th>角色</th>--}}
            <th width="130">加入时间</th>
            <th width="100">是否已启用</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($adminUsers as $adminUser)
        <tr class="text-c">
            <td><input type="checkbox" value="{{$adminUser->id}}" name="adminUsers[]"></td>
            <td>{{$adminUser->id}}</td>
            <td>{{$adminUser->name}}</td>
            <td>{{$adminUser->email}}</td>
            {{--<td>超级管理员</td>--}}
            <td>{{$adminUser->created_at}}</td>
            <td class="td-status">
                @if($adminUser->status==0)
                    {{--<span class="label label-success radius">已启用</span>--}}
                    <button onClick="admin_stop(this,'{{$adminUser->id}}')" class="btn btn-success radius size-MINI" >已启用</button>
                @else
                    <button onClick="admin_stop(this,'{{$adminUser->id}}')" class="btn btn-danger radius size-MINI">已停用</button>
                    {{--<span class="label label-danger radius">停用</span>--}}
                @endif
            </td>
            <td class="td-manage">
                {{--<a title="状态" style="text-decoration:none"  href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>--}}
                <a title="编辑" href="{{url('admin/users').'/'.$adminUser->id.'/edit'}}" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                <a title="删除" href="javascript:;" onclick="admin_del(this,'{{$adminUser->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr>
       @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{$adminUsers->links()}}
    </div>



@endsection

@section('js')
<script type="text/javascript" src="{{admin}}/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">

    /*管理员-删除*/
    function admin_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……

            $.ajax({
                url:"http://localhost:8082/laravel54/public/admin/users/"+id+"/destroy",
                method:'get',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        alert(data.msg);
                        return;
                    }
                    if(data.error==0){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }

                }
            });


        });
    }
    /*管理员-编辑*/
//    function admin_edit(title,url,w,h){
//        //layer_show(title,url,w,h);
//        console.log(url);
//        layer.open({
//            type: 2,
//            area: [800+'px', 500 +'px'],
//            fix: true, //不固定
//            maxmin: true,
//            shade:0.4,
//            title: title,
//            content: url
//        });
//    }



    /*管理员-停用*/
    function admin_stop(obj,id){
        var text = obj.innerHTML.trim();
        if(text=="已停用") {
            layer.confirm('确认要启用吗？',function(index){
                $.ajax({
                    url:"http://localhost:8082/laravel54/public/admin/users/"+id+"/status",
                    method:'get',
                    dataType:'json',
                    success:function (data) {
                        if(data.error!=0){
                            layer.msg(data.msg);
                            return;
                        }
                        if(data.error==0){
                            obj.innerHTML="已启用";
                            obj.className = "";
                            obj.className = "btn btn-success radius size-MINI";
                            layer.msg('已启用!',{icon: 6,time:1000});

                        }

                    }
                });

            });
        }else{
            layer.confirm('确认要停用吗？',function(index){
                $.ajax({
                    url:"http://localhost:8082/laravel54/public/admin/users/"+id+"/status",
                    method:'get',
                    dataType:'json',
                    success:function (data) {
                        if(data.error!=0){
                            layer.msg(data.msg);
                            return;
                        }
                        if(data.error==0){
                            obj.innerHTML="已停用";
                            obj.className = "";
                            obj.className = "btn btn-danger radius size-MINI";
                            layer.msg('已停用!',{icon: 5,time:1000});

                        }

                    }
                });

            });




        }//endif
    }

    /*管理员-启用*/
    function admin_start(obj,id){


        layer.confirm('确认要启用吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……

            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6,time:1000});
        });
    }
</script>

@endsection