@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>{{ $pageTitle }}</h1>
			</div>
			<div class="col-sm-6 text-right">
				<a href="{{ route('admin.app.index') }}" class="btn btn-outline-dark">Back</a>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="message"></div>
	<div class="container-fluid">
		<form class="saveForm" data-storeURL="{{ route('admin.app.store') }}">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-body">                             
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="app_name">App Name</label>
										<input type="text" name="app_name" id="app_name" class="form-control" placeholder="App Name">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="Email">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="username">Username</label>
										<input type="text" name="username" id="username" class="form-control" placeholder="username">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="password">Password</label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
										<span class="toggle-password" onclick="togglePasswordVisibility('password')">
					                      <i class="fa fa-eye"></i>
					                    </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="key">Key</label>
										<input type="password" name="key" class="form-control" id="key" placeholder="Key">
										<span class="toggle-password" onclick="togglePasswordVisibility('key')">
					                      <i class="fa fa-eye"></i>
					                    </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3 row">
	                                    <div class="col-md-6">
	                                        <label for="image">Image (Optional)</label>
	                                        <input type="file" name="image" id="image" class="form-control">
	                                        <p></p>
	                                    </div>
	                                    <div class="col-md-6 text-center">
	                                        <img id="image_preview" src="#" class="img-fluid img-thumbnail" alt="Image preview" style="display:none; max-width: 50%; height: auto;">
	                                    </div>
	                                </div>
								</div>

							</div>
						</div>                                                                        
					</div>
				</div>
			</div>
			<div class="pb-5 pt-3">
				<button type="submit" class="btn btn-dark">Save</button>
			</div>
		</form>
	</div>
</section>
@endsection

@push('script')
<script>
function togglePasswordVisibility(inputId) {
    var passwordInput = $('#' + inputId);
    var icon = passwordInput.next('.toggle-password').find('i');

    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordInput.attr('type', 'password');
      icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
}
$(document).ready(function() {
    function handleFilePreview(input, previewId) {
        $(input).on('change', function(event) {
            var file = event.target.files[0];
            var previewElement = $(previewId);
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        previewElement.attr('src', e.target.result).show();
                    } else {
                        previewElement.hide();
                    }
                };
                reader.readAsDataURL(file);
            } else {
                previewElement.hide();
            }
        });
    }
    handleFilePreview('#image', '#image_preview');
});
</script>
@endpush