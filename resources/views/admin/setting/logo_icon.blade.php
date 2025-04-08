@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.setting.logo.icon.update') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="form-group col-xl-6">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <div class="profilePicPreview logoPicPrev" style="background-image: url({{ getImage(getFilePath('logoIcon').'/logo.png', '?'.time()) }})">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6 mt-2">
                                                        <div class="profilePicPreview logoPicPrev bg-dark" style="background-image: url({{ getImage(getFilePath('logoIcon').'/logo.png', '?'.time()) }})">
                                                        </div>
                                                    </div> 
                                                    <div class="mt-2 col-sm-12">
                                                        <input type="file" name="logo" id="logo" class="form-control profilePicUpload input-opacity-none" accept=".png, .jpg, .jpeg">  
                                                        <p></p>
                                                        <label for="logo" class="bg-dark p-2 mt-2 btn btn-block">Upload Logo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xl-6">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <div class="profilePicPreview logoPicPrev" style="background-image: url({{ getImage(getFilePath('logoIcon') .'/favicon.png', '?'.time()) }})">
                                                        </div>
                                                    </div> 

                                                    <div class="col-md-6 mt-2">
                                                        <div class="profilePicPreview logoPicPrev bg-dark" style="background-image: url({{ getImage(getFilePath('logoIcon') .'/favicon.png', '?'.time()) }})">
                                                        </div>
                                                    </div> 
                                                    <div class="mt-2 col-sm-12">
                                                        <input type="file" name="favicon" id="favicon" class="form-control profilePicUpload input-opacity-none" accept=".png">  
                                                        <p></p>
                                                        <label for="favicon" class="bg-dark p-2 mt-2 btn btn-block">Upload Favicon</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-dark">Update</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('script')
<script>
$(".profilePicUpload").change(function() {
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = $(input).closest('.thumb').find('.profilePicPreview');
            preview.css('background-image', 'url(' + e.target.result + ')').addClass('has-image').hide().fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
@endpush