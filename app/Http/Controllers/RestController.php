<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//ここ追加
use App\Post;


class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ここ2行追加
	$post = Post::all();
	return response()->json(['message' => 'OK', 'data' => $post,], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	//以下の7行を追加
        $post = new Post();
    	$post->author = 1;
    	$post->title = $request->title;
    	$post->content = $request->content;
    	$post->comments = 0;
    	$post->save();
	return response()->json(['title' => $post->title, 'content' => $post->content], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
	//以下の2行を追加
    	$item = Post::find($id);
    	return response()->json(['author' => $item->author, 'title' => $item->title, 'content' => $item->content, 'comments' => $item->comments], 201, [], JSON_UNESCAPED_UNICODE);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	//以下の7行を追加
        $item = Post::where('id',$id)->first();
    	$item->author = 1;
    	$item->title = $request->title;
    	$item->content = $request->content;
    	$item->comments = 0;
    	$item->save();
	return response()->json(['author' => $item->author, 'title' => $item->title, 'content' => $item->content, 'comments' => $item->comments], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //以下の2行を追加
    	Post::destroy($id);
	return response()->json(['destroy' => 'SUCCESS'], 201, [], JSON_UNESCAPED_UNICODE);	
    }
}
