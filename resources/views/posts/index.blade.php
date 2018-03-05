@extends('layouts.app')

@section('content')


@guest
@else
<a href="{{url('post/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>新增文章</a>
@endguest
<br>

@foreach($post as $item)
<label class="control-label">{{$item->title}}</label>
<br>

{{{($item->body)}}}
<br>
<hr>
@endforeach

@endsection
