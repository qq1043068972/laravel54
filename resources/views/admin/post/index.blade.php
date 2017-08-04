@extends('admin.layout.main')

@section('title')
    文章列表
@endsection

@section('content')

    <div class="text-c"> 日期范围：

        <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
    </div>

    <form action="{{url('/admin/posts/multDestroy')}}" method="post">
        {{csrf_field()}}
    <div class="cl pd-5 bg-1 bk-gray mt-20">
        <button class="l">
            <button type="submit"  class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</button>

        <span class="r">共有数据：<strong>{{$posts->count()}}</strong> 条</span>
    </div>

    @include('admin.layout.error')
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">文章列表</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="40">ID</th>
            <th width="150">标题</th>
            <th width="150">内容</th>
            {{--<th>角色</th>--}}
            <th width="130">创建时间</th>
            <th width="130">修改时间</th>
            <th width="100">审核</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr class="text-c">
            <td><input type="checkbox" value="{{$post->id}}" name="posts[]"></td>
            <td>{{$post->id}}</td>
            <td>{!! str_limit($post->title,20) !!}</td>
            <td>{!! str_limit($post->content,20) !!}</td>
            {{--<td>超级管理员</td>--}}
            <td>{{$post->created_at}}</td>
            <td>{{$post->updated_at}}</td>
            <td class="td-status">
                @if($post->status==0)
                    {{--<span class="label label-success radius">已启用</span>--}}
                    <button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-default radius size-MINI" >待审核</button>
                @elseif($post->status==1)
                    <button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-success radius size-MINI">通过</button>
                    {{--<span class="label label-danger radius">停用</span>--}}
                @else
                    <button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-danger radius size-MINI">拒绝</button>
                @endif
            </td>
            <td class="td-manage">
                {{--<a title="状态" style="text-decoration:none"  href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>--}}
                {{--<a title="编辑" href="{{url('admin/posts').'/'.$post->id.'/edit'}}" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>--}}
                <a title="删除" href="javascript:;" onclick="admin_del(this,'{{$post->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr>
       @endforeach
        </tbody>
    </table>
    </form>
    <div class="pagination">
        {{$posts->links()}}
    </div>



@endsection

@section('js')
<script type="text/javascript" src="{{admin}}/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">

    function delPosts() {

//        $('input[name="posts"]:checked').each(function() {
//            id_array.push($(this).val());//向数组中添加元素
//        });

        var posts = $('input[name="posts"]:checked');
        var data = {};
        for(var i=0; i<posts.length; i++){
            data[i] = posts[i].value;
        }

//        var json = {};
//        for(var j=0;j<data.length;j++)
//        {
//            json[j]=data[j];
//        }

       data['_toekn'] = $('input[name=_token]').val();



        var d = JSON.stringify(data);



        console.log(d);


        $.post("{{url('/admin/posts/multDestroy')}}",d,function (data) {

        },'json');

    }


    /*管理员-删除*/
    function admin_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……

            $.ajax({
                url:"http://localhost:8082/laravel54/public/admin/posts/"+id+"/destroy",
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

    function sendAjax(obj,url,text,className,numIcon) {
        $.ajax({
            url:url,
            method:'get',
            dataType:'json',
            success:function (data) {
                if(data.error!=0){
                    layer.msg("出错了!");
                    return;
                }
                if(data.error==0){
                    obj.innerHTML=text;
                    obj.className = "";
                    obj.className = className;
                    layer.msg(text,{icon: numIcon,time:1000});
                }
            }
        });
    }

    /*管理员-停用*/
    function admin_stop(obj,id){

        layer.confirm('确认要吗？',{
            btn:['待审核','通过','拒绝'],
                btn3:function(index){
                    var url = "http://localhost:8082/laravel54/public/admin/posts/"+id+"/status/"+-1;
                    sendAjax(obj,url,"拒绝","btn btn-danger radius size-MINI",5);
                }
            }
            ,function (index) {
                var url = "http://localhost:8082/laravel54/public/admin/posts/"+id+"/status/"+0;
                sendAjax(obj,url,"待审核","btn btn-default radius size-MINI",5);

            },function (index) {
                var url = "http://localhost:8082/laravel54/public/admin/posts/"+id+"/status/"+1;
                sendAjax(obj,url,"通过","btn btn-success radius size-MINI",6);
            }

        );//confirm
    }

//    /*管理员-启用*/
//    function admin_start(obj,id){
//
//
//        layer.confirm('确认要启用吗？',function(index){
//            //此处请求后台程序，下方是成功后的前台处理……
//
//            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
//            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
//            $(obj).remove();
//            layer.msg('已启用!', {icon: 6,time:1000});
//        });
//    }
</script>

@endsection