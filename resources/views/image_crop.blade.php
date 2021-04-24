<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="/css/jquery.Jcrop.min.css" type="text/css" />

<script src="/js/image_crop.js?v={{ filemtime(public_path('js/image_crop.js')) }}"></script>
<script src="/js/jquery.Jcrop.min.js?v={{ filemtime(public_path('js/jquery.Jcrop.min.js')) }}"></script>

<style>
    /* body {
        width: 550px;
        font-family: Arial;
    } */

    input#crop {
        padding: 5px 25px 5px 25px;
        background: lightseagreen;
        border: #485c61 1px solid;
        color: #FFF;
        visibility: hidden;
    }

    #cropped_img {
        /* margin-top: 40px; */
    }
</style>

<div class="row">
    <div class="col-md-6">
        <label class="form-control">裁切前</label>
        <div>
            <img src="/img/original-image.jpeg" id="cropbox" class="img" />
        </div>
        <br />
        <div id="btn">
            <input type='button' id="crop" value='裁切' class="btn btn-primary">
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-control">裁切後</label>
        <div>
            <img src="#" id="cropped_img" style="display: none;">
        </div>
    </div>
</div>
