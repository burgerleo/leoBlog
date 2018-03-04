@extends('layouts.app')

@section('content')
    <!-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script> -->
    <!-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> -->
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>

    
<div><label>標題</label>
	<input type="text" name="tittle">
</div>

<textarea name="body">

</textarea>

<button id="alertContent">取得HTML</button>
<script>
    CKEDITOR.replace('body');
    $('#alertContent').click(function(){
	 	// CKEDITOR.instances.editorDemo.updateElement();
		// console.log($('textarea[name=body]').val());
		console.log(CKEDITOR.instances.body.getData());
	});
</script>

@endsection
