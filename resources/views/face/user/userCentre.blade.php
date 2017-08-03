@extends('face.layout.main')


@section('content')


    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{face}}/images/user.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$userInfo->name}}
            </p>


            <footer>关注：{{$userInfo->stars_count}}｜粉丝：{{$userInfo->fans_count}}｜文章：{{$userInfo->posts_count}} </footer>
            {{--@include('face.layout.like',['target_user'=>$userInfo])--}}

        </blockquote>
    </div>

    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <h1 class="blog-post-title"><a href="{{url('/posts')}}/{{$post->id}}" >{{$post->title}}</a></h1>
                        <p class="blog-post-meta">{{$post->updated_at->toFormattedDateString()}} by <a href="{{url('user/me')}}/{{$post->user_id}}">{{$post->user->name}}</a></p>
                        <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}}</p>
                        <p>{!! str_limit($post->content,50) !!}</p>
                    </div>
                    @endforeach
                        {{$posts->links()}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @if($susers->count()!=0)
                    @foreach($susers as $suser)

                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$suser->name}}</p>
                            <p class="">关注：{{$suser->stars_count}} | 粉丝：{{$suser->fans_count}}｜ 文章：{{$suser->posts_count}}</p>
                        </div>

                    @endforeach
                    @endif

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fusers as $fuser)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fuser->name}}</p>
                            <p class="">关注：{{$fuser->stars_count}} | 粉丝：{{$fuser->fans_count}}｜ 文章：{{$fuser->posts_count}}</p>
                        </div>
                    @endforeach
                    {{--@include('face.layout.like',['target_user'=>$userInfo])--}}
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->
@endsection

@section('js')
<script type="text/javascript">
    $(".like-button").click(function (event) {
        var target = $(event.target);
        var current_like = target.attr("like-value");
        var btnText = target.text().trim();
        var user_id = target.attr("like-user");
        if(btnText == "取消关注"){
            $.ajax({
                url:"http://localhost:8082/laravel54/public/users/"+user_id+"/unfan",
                method:'GET',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        alert(data.msg);
                        return;
                    }
                    //target.attr("like-value",0);
                    target.text("关注");
                }
            })
        }else {
            $.ajax({
                url:"http://localhost:8082/laravel54/public/user/"+user_id+"/fan",
                method:'GET',
                dataType:'json',
                success:function (data) {
                    if(data.error!=0){
                        alert(data.msg);
                        return;
                    }
                    //target.attr("like-value",1);
                    target.text("取消关注");
                }
            })
        }
    });
</script>

@endsection