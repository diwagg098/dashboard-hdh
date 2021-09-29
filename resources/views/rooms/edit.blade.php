@extends('layout.main')
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@section('content')
<div class="main-panel">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title "> Edit Rooms Table</h4>
                <p class="card-category"> Dashboard / Table Rooms / Edit</p>
            </div>
            <div class="card-body">
                <div class="testbox">
    <form action="{{ url('/rooms/update/' . $content->id_kamar)}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="banner">
        <h1>Edit Room</h1>
    </div>
    <div class="item">
        <p>Nama Kamar</p>
        <input type="text" name="nama_kamar" required placeholder="Nama Kamar" value="{{ $content->nama_kamar}}"/>
    </div>
    <div class="item">
        <p>Harga</p>
        <input type="text" name="harga" required placeholder="Harga" value="{{ $content->price}}">
    </div>
    <div class="item">
        <p>Deskripsi Kamar</p>
        <textarea class="ckeditor" id="ckedtor" name="description">{!! $content->description !!}</textarea>
    </div>
    <div class="file-upload">
        <img src="{{ asset('/images/rooms/' . $content->foto)}}" alt="" width="500" class="mb-2">
        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Update Foto</button>
        <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="foto" onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>
    <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
</div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <footer class="footer">
    <div class="container-fluid">
        <nav class="float-left">
        <ul>
            <li>
            <a href="https://www.creative-tim.com">
                Creative Tim
            </a>
            </li>
            <li>
            <a href="https://creative-tim.com/presentation">
                About Us
            </a>
            </li>
            <li>
            <a href="http://blog.creative-tim.com">
                Blog
            </a>
            </li>
            <li>
            <a href="https://www.creative-tim.com/license">
                Licenses
            </a>
            </li>
        </ul>
        </nav>
        <div class="copyright float-right">
        &copy;
        <script>
            document.write(new Date().getFullYear());
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
        </div>
    </div>
    </footer>
</div>
</div>
<script>
    function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
});

</script>
@endsection