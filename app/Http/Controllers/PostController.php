<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\cURL;
use App\post;
use Storage;
use Auth;

class PostController extends Controller
{

    public function __construct(cURL $cURL)
    {
        $this->curl = $cURL;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '文章頁面';
        $post = post::select('title', 'view','created_at','updated_at')->get();
        $data = compact('title','post'); 
        return view('posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $rules = [
            'title' => 'required|max:150',
        ];
        $messages = [
            'title.required' =>'要有標題!!!',
            // 'tittle.max' =>'請再上傳最大1mb的檔案',
        ];
        $this->validate($request,$rules,$messages);
        $post = $request->all();
        // $body = $request->body;
        // $title = $request->title;
        // $user_id = $request->user_id;
        // $post = compact('user_id','body','title');
        post::create($post);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
