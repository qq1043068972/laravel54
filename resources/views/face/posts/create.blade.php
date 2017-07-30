@extends('face.layout.main')

@section('content')

    <div class="col-sm-8 blog-main">
        <form action="{{url('/posts')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
        <br>
    </div><!-- /.blog-main -->

@endsection
@section('js')
    <script type="text/javascript" src="{{MyStyle}}/js/wangEditor.min.js"></script>
@endsection
