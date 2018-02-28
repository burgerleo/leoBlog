@extends('layouts.app')

@section('content')
<link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
<link href="{{ asset('css/demo.css') }}" rel="stylesheet">
<style type="text/css">
/*以下可刪*/
button,
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
}
/*以上可刪*/
.crop{display:none}
.up-demo{
    position: relative;
    text-align: center;
    top: 50px;
}
</style>

<form  enctype="multipart/form-data">
<div class="container">
    <div class="grid">
        <div class="actions">
            <div class="col-1-2">
                <button class="btn file-btn">
                    <span>上傳</span>
                    <input type="file" id="upload" value="Choose a file" />
                    <button class="btn upload-result">裁剪</button>
                    <div class="upload-msg" id='cut-msg'>
                        Cut in here
                    </div>
                    <div id="result" class="up-demo"></div>
                </button>
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
    </div>
<button type="submit" class="btn">Save</button>

</div>
</form>

<form action={{ url('post') }} method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="">選擇一個PDF</label><br>
    <input type="file" name="img" id="file"><br>
<button type="submit">submit</button>
</form>

<script src="{{ asset('js/croppie.js') }}"></script>

<script type="text/javascript">
$(".upload-result").hide();
$('#cut-msg').hide();

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
        alert("Sorry - you're browser doesn't support the FileReader API");
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
    }
    $("#result").html(html);
}
</script>
@endsection
