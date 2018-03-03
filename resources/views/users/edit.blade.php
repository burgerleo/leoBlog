@extends('layouts.app')

@section('content')
<link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
<link href="{{ asset('css/demo.css') }}" rel="stylesheet">
<style type="text/css">
/*以下可刪*/
/*button,
a.btn {
    background-color: #189094;
    color: white;
    padding: 10px 15px;
    border-radius: 3px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    text-shadow: none;
}
button:focus {
    outline: 0;
}
.file-btn {
    position: relative;
}
.file-btn input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}
.actions {
    padding: 5px 0;
}
.actions button {
    margin-right: 5px;
}*/
/*以上可刪*/
.crop{
    display:none;
}
.up-demo{
    position: relative;
    text-align: center;
    top: 50px;
}
.save{
    display:none;
}
/*.upload-demo .upload-demo-wrap
.upload-demo 
.upload-demo.ready .upload-msg */

.upload-result{
    display: none;
}
#cut-msg{
    display: none;
}
</style>

<form action={{ url('head') }} method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="actions">
        <div class="col-1-2{{ $errors->has('oldImg') ? ' has-error' : '' }}">
            <button class="btn file-btn">
                <span>上傳</span>

                <input type="file" id="upload" name="oldImg" value="Choose a file" />
                <button type="button" class="btn upload-result">裁剪</button>
                <div class="upload-msg" id='cut-msg'>
                    Cut in here
                </div>
                <div id="result" class="up-demo"></div>
            </button>
            @if ($errors->has('oldImg'))
                <span class="help-block">
                    <strong>{{ $errors->first('oldImg') }}</strong>
                </span>
            @endif
        </div> 
        <div class="col-1-2">
            <div class="upload-msg" id='up-msg'>
                Upload a file to start cropping
            </div>
            <div class="crop">
                <div id="upload-demo"></div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn save" >Save</button>
</form>
<script src="{{ asset('js/croppie.js') }}"></script>

<script type="text/javascript">

var $uploadCrop;

$uploadCrop = $('#upload-demo').croppie({
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('#upload').on('change', function () { 
    $(".crop").show();
    $(".upload-result").show();
    $('#cut-msg').show();
    $('#up-msg').hide();
    $('.help-block').hide();
    $('#result').empty();
    readFile(this); 
});
$('.upload-result').on('click', function (ev) {
    $('#cut-msg').hide();
    $uploadCrop.croppie('result', 'canvas').then(function (resp) {
        popupResult({
            src: resp
        });
    });
});

function readFile(input) 
{
    console.log(input.files[0]);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            });
        }
        
        reader.readAsDataURL(input.files[0]);
    }
    else {
        alert("Plase select Img");
        $(".crop").hide();
        $("#up-msg").show();
        $('.save').hide();
        $(".upload-result").hide();

        // alert("Sorry - you're browser doesn't support the FileReader API");
    }
}
    
function popupResult(result) 
{
    var html;
    if (result.html) {
        html = result.html;
    }
    if (result.src) {
        html = '<img src="' + result.src + '" />';
        html += '<input type="hidden" name="newImg" value="' + result.src + '" />';
    }
    $("#result").html(html);
    $('.save').show();
}
</script>
@endsection
