@extends('cms.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/uploads') }}" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="photos">Select photos</label>

                            <div class="col-md-6">
                                <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                                <img id="blah" src="#" alt="your photo" />
                                <p class="help-block">Upload your avatar.</p>
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <div class="col-md-6">
                                <input type="hidden" id="attach" name="attach" value="attach">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
    // Set csrf-token into ajax header.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // read photos
    $('#photos').change(function() {
        readURL(this);
        console.log('start = ' + new Date().toLocaleString());
        upload();
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(250);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // upload photos.
    function upload() {
        var formData = new FormData($('form')[0]);

        $.ajax({
            url: '/uploads',
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(data){
                console.log('end   = ' + new Date().toLocaleString());
                console.log(data);
            }
        });
    }

    </script>
@endsection
