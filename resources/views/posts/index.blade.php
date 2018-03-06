@extends('layouts.app')

@section('content')


@guest
@else
<a href="{{url('post/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>新增文章</a>
@endguest
<br>

@foreach($post as $item)
<!-- <div>
	<label class="control-label">{{$item->title}}</label>
</div> -->
        <!-- <li>{{$item->title}}</li>  -->
        <!-- <li class="right">{{$item->view}}</li>  -->
<div class="col-sm-10">{{$item->title}}</div>
<div class="col-sm-2">{{$item->view}}</div>
<!-- {!! $item->body !!} -->
@endforeach


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  	Launch demo modal
</button>

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

@endsection
