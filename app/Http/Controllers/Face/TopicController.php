<?php

namespace App\Http\Controllers\Face;

use App\Models\Post;
use App\Models\PostTopic;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Topic $topic) {
        //dd($topic);
        //带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);

        //dd($topic);

        //专题文章列表
        $posts = $topic->posts()->orderBy('updated_at','desc')->paginate(4);
        $posts->load('user');
        //$posts = $topic->posts()->orderBy('updated_at','desc')->paginate(4);
        //$posts->load('user');
        //dd($posts);
        //属于我的文章，但是为投稿
        $myPosts = Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();

        //dd($myPosts);

        return view('face.topic.index',compact('topic','posts','myPosts'));
    }

    public function submit(Topic $topic) {

        $this->validate(request(),[
           'post_ids'=>'required | array',
        ]);

        $postIds = request('post_ids');
        try{
            foreach ($postIds as $postId){
                $post_id = $postId;
                $topic_id = $topic->id;
                PostTopic::firstOrCreate(compact('post_id','topic_id'));
            }
            return back()->with('success','投稿成功!');

        }catch (\Exception $exception){
            return back()->with('error', '投稿失败!'.$exception);
        }

    }
}
