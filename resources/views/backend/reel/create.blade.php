@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add Reel')}}</h5>
</div>

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">

            <form class="p-4" action="{{ route('storeReel') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="title">{{translate('Title')}} </label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Title')}}" id="title" name="title" value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Reel')}} </label>
                    <div class="col-md-9">
                        <div class="mb-3">

                            <input class="form-control" type="file" accept="video/*" name="reel" id="formFile">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#formFile').change(function() {
        var file = this.files[0];
        var video = document.createElement('video');
        var url = URL.createObjectURL(file);

        video.addEventListener('loadedmetadata', function() {
            var width = this.videoWidth;
            var height = this.videoHeight;
            var size = file.size; // in bytes

            if (width != 1080 || height != 1920) {
                alert('Please upload a video with dimensions greater than 1080x1920.');
                $('#formFile').val(''); // Clear the file input
                return;
            }

            if (size > 50 * 1024 * 1024) { // Convert MB to bytes
                alert('Please upload a video with a maximum size of 50MB.');
                $('#formFile').val(''); // Clear the file input
                return;
            }
        });

        video.src = url;
    });
</script>

@endsection