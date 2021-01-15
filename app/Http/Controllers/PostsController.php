<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
//以下の1行を追加
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller{
    public function list(){
    	$posts = Post::orderBy('created_at','desc')->paginate(10);
    	//以下の2行を追加　return文を変更
    	$user_model = new User;
	$user_complex = array_column($user_model::all()->toArray(),'name','id');
    	return view('posts.list',['user' => Auth::user(), 'id' => Auth::id(), 'posts' => $posts, 'users' => $user_complex]);
    }

    public function insert(){
    	return view('posts.insert');
    }

    public function do_insert(Request $request){
	$validatedData = $request->validate(['title' => 'required|String|max:20','content' => 'required|String|between:10,140',]);
    	$post = new Post();
    	//以下の1行を変更
    	$post->author = Auth::id();
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->comments = 0;
    	$post->save();
    	return redirect('/');
    }

    public function show($id){
    	$item = Post::find($id);
    	//以下の6行を追加　return文を変更
    	$author_model = new User;
	if(isset($author_model::find($item->author)->name)){
		$author_name = $author_model::find($item->author)->name;
	} else {
		$author_name = "存在しないユーザー";
	}
    	return view('posts.show',['posts' => $item, 'author_name' => $author_name]);
    }

    public function update($id){
    	$item = Post::find($id);
    	return view('posts.update',['posts' => $item]);
    }

    public function do_update(Request $request){
	$validatedData = $request->validate(['title' => 'String|max:20|required','content' => 'required|String|between:10,140',]);
    	$post = Post::where('id',$request->id)->first();
    	//以下の1行を変更
    	$post->author = Auth::id();
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
