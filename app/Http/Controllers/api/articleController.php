<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\post;


class articleController extends Controller
{
    public function getPost($id)
    {
    	$post = post::where('id',$id)->first();
    	$view = $post['view'];
    	$view++;
    	post::where('id',$id)->update(['view' => $view]);
    	return ($post);
    }
}
