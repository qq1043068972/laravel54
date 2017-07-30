<?php

namespace App\Http\Controllers\Face;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index() {

        $posts = Post::orderBy('id','desc')->paginate(4);
        return view('face.posts.index',compact('posts'));
    }

    public function show(Post $post) {
        return view('face.posts.show',compact('post'));
    }

    public function create() {
        return view('face.posts.create');
    }

    public function store() {
        $post = Post::create(request(['title','content']));
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

    
}
