@extends('face.layout.main')

@section('content')


    <div class="col-sm-8 blog-main">
        <form action="{{url('/posts')}}/{{$post->id}}" method="post">
            {{csrf_field()}}
            <input hidden="hidden" name="_method" value="PUT" />
            <input hidden="hidden" name="id" value="{{$post->id}}" />
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">
                    {!! $post->content !!}

                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
        <br>
    </div><!-- /.blog-main -->

@endsection
@section('js')
    <script type="text/javascript" src="{{MyStyle}}/js/wangEditor.min.js"></script>
@endsection
