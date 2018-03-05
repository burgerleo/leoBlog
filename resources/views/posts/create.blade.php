@extends('layouts.app')

@section('content')
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/unisharp/laravel-ckeditor/contents.css')}}">

<form action="{{url('post')}}" method="post">
    {{ csrf_field() }}    
    <input type="hidden" name="user_id" value="{{auth::user()->id}}" required autofocus>

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="control-label">標題</label>
        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    <label for="body" class="control-label">內容</label>
    </div>
    
    <textarea name="body" value="{{ old('body') }}">
        @if ($errors->has('body'))
            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>
        @endif
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
