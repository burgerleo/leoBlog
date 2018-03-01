<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cURL extends Controller
{
   	//curl (get)
    public function getcurl($url){
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);    //設置url屬性
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);   //獲取數據
        curl_close($ch);    //關閉curl
        return $output;
    }

    //curl (post)
    public function postcurl($url,$data){
        $dataJson = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                            
            'Content-Type: application/json',                                       
            'Content-Length: ' . strlen($dataJson))                             
        );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    //curl (put)
    public function putCurl($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;

    }
}
