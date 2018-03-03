@extends('layouts.app')

@section('content')
<style type="text/css">
	span{
	    margin-top: 5px;
	    margin-bottom: 10px;
	    font-size: 24px;
	}
</style>
@guest
@else
<a href="{{url('post/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>新增文章</a>
@endguest

@endsection
