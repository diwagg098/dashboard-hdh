@extends('layout.main')
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@section('content')

<style>
  /*Copied from bootstrap to handle input file multiple*/
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

/*Also */
.btn-success {
    border: 1px solid #c5dbec;
    background: #d0e5f5;
    font-weight: bold;
    color: #2e6e9e;
}

/* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
.fileinput-button {
    position: relative;
    overflow: hidden;
}

.fileinput-button input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    -ms-filter: "alpha(opacity=0)";
    font-size: 200px;
    direction: ltr;
    cursor: pointer;
}

.thumb {
    height: 80px;
    width: 100px;
    border: 1px solid #000;
}

ul.thumb-Images li {
    width: 120px;
    float: left;
    display: inline-block;
    vertical-align: top;
    height: 120px;
}

.img-wrap {
    position: relative;
    display: inline-block;
    font-size: 0;
}

.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #d0e5f5;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bolder;
    cursor: pointer;
    opacity: 0.5;
    font-size: 23px;
    line-height: 10px;
    border-radius: 50%;
}

.img-wrap:hover .close {
    opacity: 1;
    background-color: #ff0000;
}

.FileNameCaptionStyle {
    font-size: 12px;
}

</style>
<div class="main-panel">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title "> Create New Gallery</h4>
                <small class="card-category font-italic"> Dashboard / Gallery / Create</small>
            </div>
            <div class="card-body">
                <div class="testbox">
    <form action="{{ url('/gallery/store')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="banner">
        <h1>Create Gallery</h1>
    </div>
<div class="item form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
            <label style="font-size: 14px;">
                <span style='font-weight:bold'>Images Upload Instruction :</span>
            </label>
            <ul>
                <li>
                    Allowed only files with extension (jpg, png)
                </li>
                <li>
                    Maximum number of allowed files 100 with 2400 KB for each
                </li>
                <li>
                    Upload 5 files
                </li>
            </ul>
            <!--To give the control a modern look, I have applied a stylesheet in the parent span.-->
            <span class="btn btn-success fileinput-button">
                <span>Select Images</span>
                <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
            </span>
            <output id="Filelist"></output>
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

 <script>
    //I added event handler for the file upload control to access the files properties.
    document.addEventListener("DOMContentLoaded", init, false);

    //To save an array of attachments
    var AttachmentArray = [];

    //counter for attachment array
    var arrCounter = 0;

    //to make sure the error message for number of files will be shown only one time.
    var filesCounterAlertStatus = false;

    //un ordered list to keep attachments thumbnails
    var ul = document.createElement("ul");
    ul.className = "thumb-Images";
    ul.id = "imgList";

    function init() {
    //add javascript handlers for the file upload event
    document
        .querySelector("#files")
        .addEventListener("change", handleFileSelect, false);
    }

    //the handler for file upload event
    function handleFileSelect(e) {
    //to make sure the user select file/files
    if (!e.target.files) return;

    //To obtaine a File reference
    var files = e.target.files;

    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f; (f = files[i]); i++) {
        //instantiate a FileReader object to read its contents into memory
        var fileReader = new FileReader();

        // Closure to capture the file information and apply validation.
        fileReader.onload = (function(readerEvt) {
        return function(e) {
            //Apply the validation rules for attachments upload
            ApplyFileValidationRules(readerEvt);

            //Render attachments thumbnails.
            RenderThumbnail(e, readerEvt);

            //Fill the array of attachment
            FillAttachmentArray(e, readerEvt);
        };
        })(f);

        // Read in the image file as a data URL.
        // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
        // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
        fileReader.readAsDataURL(f);
    }
    document
        .getElementById("files")
        .addEventListener("change", handleFileSelect, false);
    }

    //To remove attachment once user click on x button
    jQuery(function($) {
    $("div").on("click", ".img-wrap .close", function() {
        var id = $(this)
        .closest(".img-wrap")
        .find("img")
        .data("id");

        //to remove the deleted item from array
        var elementPos = AttachmentArray.map(function(x) {
        return x.FileName;
        }).indexOf(id);
        if (elementPos !== -1) {
        AttachmentArray.splice(elementPos, 1);
        }

        //to remove image tag
        $(this)
        .parent()
        .find("img")
        .not()
        .remove();

        //to remove div tag that contain the image
        $(this)
        .parent()
        .find("div")
        .not()
        .remove();

        //to remove div tag that contain caption name
        $(this)
        .parent()
        .parent()
        .find("div")
        .not()
        .remove();

        //to remove li tag
        var lis = document.querySelectorAll("#imgList li");
        for (var i = 0; (li = lis[i]); i++) {
        if (li.innerHTML == "") {
            li.parentNode.removeChild(li);
        }
        }
    });
    });

    //Apply the validation rules for attachments upload
    function ApplyFileValidationRules(readerEvt) {
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
        alert(
        "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, You can only upload jpg/png/gif files"
        );
        e.preventDefault();
        return;
    }

    //To check file Size according to upload conditions
    if (CheckFileSize(readerEvt.size) == false) {
        alert(
        "The file (" +
            readerEvt.name +
            ") does not match the upload conditions, The maximum file size for uploads should not exceed 3 MB"
        );
        e.preventDefault();
        return;
    }

    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
        if (!filesCounterAlertStatus) {
        filesCounterAlertStatus = true;
        alert(
            "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
        );
        }
        e.preventDefault();
        return;
    }
    }

    //To check file type according to upload conditions
    function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
        return true;
    } else if (fileType == "image/png") {
        return true;
    } else if (fileType == "image/gif") {
        return true;
    } else {
        return false;
    }
    return true;
    }

    //To check file Size according to upload conditions
    function CheckFileSize(fileSize) {
    if (fileSize < 3000000) {
        return true;
    } else {
        return false;
    }
    return true;
    }

    //To check files count according to upload conditions
    function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array,
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
        if (AttachmentArray[i] !== undefined) {
        len++;
        }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
        return false;
    } else {
        return true;
    }
    }

    //Render attachments thumbnails.
    function RenderThumbnail(e, readerEvt) {
    var li = document.createElement("li");
    ul.appendChild(li);
    li.innerHTML = [
        '<div class="img-wrap"> <span class="close">&times;</span>' +
        '<img class="thumb" src="',
        e.target.result,
        '" title="',
        escape(readerEvt.name),
        '" data-id="',
        readerEvt.name,
        '"/>' + "</div>"
    ].join("");

    var div = document.createElement("div");
    div.className = "FileNameCaptionStyle";
    li.appendChild(div);
    div.innerHTML = [readerEvt.name].join("");
    document.getElementById("Filelist").insertBefore(ul, null);
    }

    //Fill the array of attachment
    function FillAttachmentArray(e, readerEvt) {
    AttachmentArray[arrCounter] = {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size
    };
    arrCounter = arrCounter + 1;
    }


    </script>
@endsection