@extends('face.layout.main')

@section('content')

    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>

                @can('update',$post)
                <a style="margin: auto"  href="{{url('posts/'.$post->id.'/edit')}}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                @endcan
                @can('delete',$post)
                <a style="margin: auto" onclick="dialog.confirmDel('{{url('posts/'.$post->id.'/destroy')}}')">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
                @endcan

            </div>

            <p class="blog-post-meta">{{$post->updated_at->toFormattedDateString()}} by <a href="{{url('user/me')}}/{{$post->user_id}}">{{$post->user->name}}</a></p>

            <p><p>{!! $post->content !!}</p><p><br></p>


            {{--zan方法应该跟一个属性样用，不能加括号的，但是不知道为啥，必须要加括号了,否则提示不能在Call to a member function exists() on null--}}
            @if($post->zan()->exists())
            <div>
                <a href="{{url('posts/'.$post->id.'/unzan')}}" type="button" class="btn btn-primary btn-lg">取消赞</a>
            </div>
            @else
            <div>
                <a href="{{url('posts/'.$post->id.'/zan')}}" type="button" class="btn btn-primary btn-lg">赞</a>
            </div>
            @endif
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($post->comments as $comment)
                <li class="list-group-item">
                    <h5>{{$comment->created_at}} by {{$comment->user->name}}</h5>
                    <div>
                        {{$comment->content}}
                    </div>
                </li>
                @endforeach
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
                    <input type="hidden" name="user_id" value="{{$user->id}}"/>
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-primary" type="submit">提交</button>
                    @include('face.layout.validatesError')
                    @include('face.layout.error')
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->

@endsection

