<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\cURL;
use Storage;

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
        return view('users.post');
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
        $data = $request->url;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $filename = 'public/img/'.md5(time()).'.png';
        $destinationPath = public_path().'/img/';
        // return $destinationPath;
        // Storage::put($filename, $data, 'img');
        // return $t;
        // Storage::put($filename, $data, 'img');
        Storage::put($filename, $data);
        return ;

       try{
            $url = $request->url;
            list($type, $url) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            return $data;
            // file_put_contents('image64.png', $data);
            Storage::put('file.jpg', $data, 'public');
            return $data;
            // Storage::put('file.jpg', $png, 'public');
            // $filetype = $png->getMimeType();
            return $url;
            $destinationPath = public_path().'/img/';
            $filename = $request->img->getclientoriginalname();
            $filetype = $request->img->getMimeType();
            if($filetype!='image/png'){
                return $filetype;
            }
            return strtolower($request->img->getClientOriginalExtension());

            $unique_name = md5($filename. time()).'.png';
            $request->file('img')->move($destinationPath,$unique_name);        
            return "OK";
        }
        catch (\Exception $e){
            return "發生錯誤";
        }
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
