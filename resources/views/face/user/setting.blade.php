
@extends('face.layout.main')

@section('content')

    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="{{url('user/me/setting')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input hidden="hidden" name="id" value="{{$user->id}}"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-10">
                    <input class="form-control" name="email" type="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">注册时间</label>
                <div class="col-sm-10">
                    <input disabled="disabled" class="form-control"  type="text" value="{{$user->created_at}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">更新时间</label>
                <div class="col-sm-10">
                    <input disabled="disabled" class="form-control"  type="text" value="{{$user->updated_at}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class="file-loading preview_input" type="file" value="用户名" style="width:72px" name="avatar">
                </div>
            </div>

            @include('face.layout.validatesError')
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
        <br>

    </div>



@endsection

