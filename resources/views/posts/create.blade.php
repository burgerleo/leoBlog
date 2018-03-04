@extends('layouts.app')

@section('content')
    <!-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script> -->
    <!-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/unisharp/laravel-ckeditor/contents.css')}}">

    
<div><label>標題</label>
	<input type="text" name="tittle">
</div>
<form action="{{url('post')}}" method="post">
	{{ csrf_field() }}
<textarea name="body">

</textarea>
<button type="submit" class="btn">save</button>
</form>
<br>

<div id='result'></div>
<br>
<button id="alertContent">取得HTML</button>
<script>
    CKEDITOR.replace('body');
    $('#alertContent').click(function(){
	 	// CKEDITOR.instances.editorDemo.updateElement();
		// console.log($('textarea[name=body]').val());
		html = CKEDITOR.instances.body.getData();
		console.log(html);

    	$("#result").html(html);

	});
</script>

@endsection
