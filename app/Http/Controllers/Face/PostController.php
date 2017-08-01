<?php

namespace App\Http\Controllers\Face;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Zan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index() {

        //withCount 填表名
        $posts = Post::orderBy('id','desc')->withCount(['comments','zans'])->paginate(4);
        $posts->load('user');
        //$posts->load('zan');

        return view('face.posts.index',compact('posts'));
    }

    public function show(Post $post) {
        $user = Auth::user();
        return view('face.posts.show',compact('post','user'));
    }

    public function create() {
        return view('face.posts.create');
    }

    public function store() {

        $user_id = Auth::id();
        $postArr = request(['title','content']);
        $postArr['user_id'] = $user_id;
        $post = Post::create($postArr);
        if(!empty($post)){
            return redirect('/posts');
        }else{
            return back()->with('error');
        }
    }

    public function edit(Post $post) {
        return view('face.posts.edit',compact('post'));
    }

    public function update(Post $post) {

        $this->authorize('update',$post);

        $this->validate(request(),[
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->title = request()->input('title');
        $post->content = request()->input('content');
        if($post->save()){
            return redirect('/posts')->with('success','修改成功!');
        }else{
            return back()->with('error','修改失败!');
        }
    }

    public function destroy(Post $post) {
        if($post->delete()){
            return redirect('/posts')->with('success','删除成功!');
        }else{
            return redirect('/posts')->with('error','删除失败!');
        }
    }

    public function comment() {

        $this->validate(request(),[
            'user_id' => 'required',
            'post_id' => 'required',
            'content' => 'required'
        ]);

        if(empty(Comment::create(request(['content','user_id','post_id'])))){
            return back()->with('error','评论失败');
        }else{
            return back();
        }
    }

    public function zan(Post $post) {

        $zanArr = [
            'user_id'=>Auth::id(),
            'post_id'=>$post->id
        ];

        Zan::firstOrCreate($zanArr);
        return back();
    }

    public function unzan(Post $post) {
        $zan = Zan::where('post_id',$post->id)->where('user_id',Auth::id());
        $zan->delete();
        return back();
    }
    
}
