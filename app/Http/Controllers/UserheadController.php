<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userhead;
use Storage;
use Auth;


class UserheadController extends Controller
{

	public function store(Request $request)
    {
    	$rules = [
            'oldImg' => 'required|max:1024|min:20',
        ];
        $messages = [
            'oldImg.required' =>'請再上傳照片',
            'oldImg.max' =>'請再上傳最大1mb的檔案',
            'oldImg.min' =>'請再上傳最小20kb的檔案',
        ];
        $this->validate($request,$rules,$messages);

        $user_id = Auth::user()->id;
        $data = $request->newImg;
        $img = $this->croppieImg($data);//轉換成圖片
        $newImg = md5(time()).'.png';
        $filePath = 'public/img/'.$user_id.'/'.$newImg;
        Storage::put($filePath, $img);

        $filename = $request->oldImg->getclientoriginalname();	//取得上傳檔案名稱
        $filetype = strtolower($request->oldImg->getClientOriginalExtension());//取得副檔名
        $destinationPath = public_path().'/storage/img/'.$user_id.'/';	//編輯儲存路徑
        $oldImg = md5($filename. time()).'.'.$filetype;
        $request->file('oldImg')->move($destinationPath,$oldImg);
        userhead::updateOrCreate(
    	 	['id' => $user_id],compact('oldImg','newImg')
        );
        return redirect('/');
    }
    public function croppieImg($data){
    	list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        return $data;
    }
    public function error(){
       try{
        }
        catch (\Exception $e){
            return "發生錯誤";
        }
    }

}
