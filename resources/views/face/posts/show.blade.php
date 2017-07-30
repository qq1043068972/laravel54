@extends('face.layout.main')

@section('content')

    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>
                <a style="margin: auto"  href="{{url('posts/'.$post->id.'/edit')}}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a style="margin: auto" onclick="dialog.confirmDel('{{url('posts/'.$post->id.'/destroy')}}')">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>

            </div>

            <p class="blog-post-meta">{{$post->updated_at->toFormattedDateString()}} by <a href="#">{{$post->user_id}}</a></p>

            <p><p>{!! $post->content !!}</p><p><br></p>
            <div>
                <a href="{{'posts/'.$post->id.'/zan'}}" type="button" class="btn btn-primary btn-lg">赞</a>

            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>2017-05-28 10:15:08 by Kassandra Ankunding2</h5>
                    <div>
                        这是第一个评论
                    </div>
                </li>
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="{{url('posts/comment')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="post_id" value="{{$post->id}}"/>
                    <li class="list-group-item">
                        <textarea name="comment" class="form-control" rows="10"></textarea>
                        <button class="btn btn-primary" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->

@endsection
