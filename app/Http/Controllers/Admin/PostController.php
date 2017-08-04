<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('admin.post.index',compact('posts'));
    }

    public function isStatus(Post $post,$num) {
        $post->status = $num;

        if($post->save()){
            return [
                'error' => 0
            ];
        }else{
            return [
                'error' => 1
            ];
        }
    }

    public function destroy(Post $post) {
        if($post->delete()){
            return [
                'error' => 0
            ];
        }else{
            return [
                'error' => 1
            ];
        }
    }

    public function multDestroy() {

        $postsArr = request()->input('posts');
        foreach ($postsArr as $k => $v){
            if(Post::find($v)->delete()){
                continue;
            }else{
                return back()->withErrors($v.'删除出错!');
            }
        }
        return back();
    }

    public function getDelPosts() {
        $delPosts = Post::onlyTrashed()->paginate(10);
        return view('admin.post.dels',compact('delPosts'));
    }

    public function restore($id) {
        $post = Post::onlyTrashed()->find($id);
        if($post->restore()){
            return [
                'error' => 0
            ];
        }else{
            return [
                'error' => 1
            ];
        }
    }

    public function getRefusedPosts() {
        $refusedPosts = Post::where('status',-1)->paginate(10);
        return view('admin.post.refused',compact('refusedPosts'));
    }

}
