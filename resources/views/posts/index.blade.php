@extends('layouts.app')

@section('content')


@guest
@else
<a href="{{url('post/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>新增文章</a>
@endguest
<br>

@foreach($post as $item)
<div class="col-sm-12">
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-whatever="{{$item->id}}">
	  	{{$item->title}}
	</button>
</div>

@endforeach

<br>
<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">
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
        	<div class="form-group">
	            <label for="recipient-name" class="control-label">Recipient:</label>
	            <input type="text" class="form-control" id="recipient-name">
         	 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var body;
	
$('#myModal').on('show.bs.modal', function (event) {
	console.log(event.relatedTarget);
	var button = $(event.relatedTarget)  
	var id = button.data('whatever')  
	getbody(id);
	// console.log(body);
	var modal = $(this)	
	// modal.find('.modal-title').text('New message to ' + recipient)
	// modal.find('.modal-body input').val(recipient)
	console.log(body);
	$('.modal-body').html(body);

})

function getbody(id)
{
	console.log(id);
	$.ajax({
		url: "{{url('/api/getArticle')}}/"+id,
		dataType: 'json',
		type:'get',
		success: function(data) {
			// console.log(data);

			body = data.body;
			console.log(body);
			$('.modal-body').html(body);

			if (!data) {
				alert('資料有誤更新失敗');
			}
		},error:function(request,error){
            alert(error + " : " + request.responseText);     
		}
	});
}
</script>
@endsection
