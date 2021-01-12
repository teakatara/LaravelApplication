<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller{
    public function list(){
    	$posts = Post::orderBy('created_at','desc')->paginate(10);
		return view('posts.list',['user' => Auth::user(), 'id' => Auth::id(), 'posts' => $posts]);
    }

    public function insert(){
    	return view('posts.insert');
    }

    public function do_insert(Request $request){
	$validatedData = $request->validate(['title' => 'required|String|max:20','content' => 'required|String|between:10,140',]);
    	$post = new Post();
    	$post->author = 1;
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->comments = 0;
    	$post->save();
    	return redirect('/');
    }

    public function show($id){
    	$item = Post::find($id);
    	return view('posts.show',['posts' => $item]);
    }

    public function update($id){
    	$item = Post::find($id);
    	return view('posts.update',['posts' => $item]);
    }

    public function do_update(Request $request){
	$validatedData = $request->validate(['title' => 'String|max:20|required','content' => 'required|String|between:10,140',]);
    	$post = Post::where('id',$request->id)->first();
    	$post->author = 1;
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->comments = 0;
    	$post->save();
    	return redirect('/');
    }

    public function drop($id){
    	Post::destroy($id);
    	return redirect('/');
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
