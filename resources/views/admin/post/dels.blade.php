@extends('admin.layout.main')

@section('title')
    已删除文章列表
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
        {{--<span class="l">--}}
            {{--<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span>--}}
        
        <span class="r">共有数据：<strong>{{$delPosts->count()}}</strong> 条</span>
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
            {{--<th width="100">审核</th>--}}
            <th width="100">恢复</th>
        </tr>
        </thead>
        <tbody>
        @foreach($delPosts as $post)
        <tr class="text-c">
            <td><input type="checkbox" value="{{$post->id}}" name="delPosts[]"></td>
            <td>{{$post->id}}</td>
            <td>{!! str_limit($post->title,20) !!}</td>
            <td>{!! str_limit($post->content,20) !!}</td>
            {{--<td>超级管理员</td>--}}
            <td>{{$post->created_at}}</td>
            <td>{{$post->updated_at}}</td>
            {{--<td class="td-status">--}}
                {{--@if($post->status==0)--}}
                    {{--<span class="label label-success radius">已启用</span>--}}
                    {{--<button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-default radius size-MINI" >待审核</button>--}}
                {{--@elseif($post->status==1)--}}
                    {{--<button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-success radius size-MINI">通过</button>--}}
                    {{--<span class="label label-danger radius">停用</span>--}}
                {{--@else--}}
                    {{--<button onClick="admin_stop(this,'{{$post->id}}')" class="btn btn-danger radius size-MINI">拒绝</button>--}}
                {{--@endif--}}
            {{--</td>--}}
            <td class="td-manage">
                {{--<a title="状态" style="text-decoration:none"  href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>--}}
                {{--<a title="编辑" href="{{url('admin/delPosts').'/'.$post->id.'/edit'}}" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>--}}
                <a title="恢复" href="javascript:;" onclick="admin_restore(this,'{{$post->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6dc;</i></a></td>
        </tr>
       @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{$delPosts->links()}}
    </div>



@endsection

@section('js')
<script type="text/javascript" src="{{admin}}/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">

    /*管理员-删除*/
    function admin_restore(obj,id){
        layer.confirm('确认要恢复吗？',function(index){
            //此处请求后台程序，下方是成功后的前台处理……

            $.ajax({
                url:"http://localhost:8082/laravel54/public/admin/posts/"+id+"/restore",
                method:'get',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        layer.msg("出错了!",1000);
                        return;
                    }
                    if(data.error==0){
                        $(obj).parents("tr").remove();
                        layer.msg('已恢复!',{icon:1,time:1000});
                    }
                }
            });


        });
    }

</script>

@endsection