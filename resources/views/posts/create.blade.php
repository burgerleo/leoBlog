@extends('layouts.app')

@section('content')
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/unisharp/laravel-ckeditor/contents.css')}}">
<style type="text/css">

</style>
<form action="{{url('post')}}" method="post">
    {{ csrf_field() }}    
    <div class="text">
    <input type="hidden" name="user_id" value="{{auth::user()->id}}">
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
    <ul class="control list-inline"> 
        <button type="button" id="preview" class="btn btn-info" data-toggle="modal" data-target="#myModal">
		  預覽
		</button>
        <li><button type="submit" class="btn btn-success">儲存</button></li> 
    </ul>
</form>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        body
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
        $('#preview').removeClass('hidden');
        $('.text').removeClass('hidden');
    });

    function preview(title,body)
    {
        $(".modal-title").html(title);
        $(".modal-body").html(body);
    }
    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#preview').removeClass('hidden');
	})
</script>

@endsection
