@extends('layouts.app')

@section('content')
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/unisharp/laravel-ckeditor/contents.css')}}">
<style type="text/css">
    .control{
        margin-top: 20px;
    }
</style>
<form action="{{url('post')}}" method="post">
    {{ csrf_field() }}    
    <div class="text">
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
    </div>
    <div id='result'></div>
    <ul class="control list-inline"> 
        <li><button type="button" id="preview" class="btn btn-info">預覽</button></li> 
        <li><button type="button" id="edit" class="btn btn-warning hidden">編輯</button></li> 
        <li><button type="submit" class="btn btn-success">儲存</button></li> 
    </ul>
</form>
<script>
    CKEDITOR.replace('body'); //文字編輯器
    $('#preview').click(function(){
	 	// CKEDITOR.instances.editorDemo.updateElement();
		// console.log($('textarea[name=body]').val());
		body = CKEDITOR.instances.body.getData();
		console.log(body);
        // $('textarea[name=body]').hide();
        title = $('input[name=title]').val();
        preview(title,body);
        $('#edit').removeClass('hidden');
        $('#edit').addClass('show');
        $('#preview').addClass('hidden');


	});
    $('#edit').click(function(){
        $('#edit').addClass('hidden');
        $('#edit').removeClass('show');
        $('#preview').removeClass('hidden');
        $("#result").addClass('hidden');
        $('.text').removeClass('hidden');

    });

    function preview(title,body)
    {
    
        html = '<label class="control-label">'+title+'</label><hr>';
        html += body;
        $("#result").html(html);
        $('.text').addClass('hidden');
        $("#result").removeClass('hidden');
        $("#result").addClass('show');

    }
</script>

@endsection
