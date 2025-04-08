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
		<form class="saveForm" data-storeURL="{{ route('admin.app.update', $data->id) }}">
			@method('PUT')
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-body">                             
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="app_name">App Name</label>
										<input type="text" name="app_name" id="app_name" value="{{ $data->app_name }}" class="form-control" placeholder="App Name">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" value="{{ $data->email }}" class="form-control" placeholder="Email">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="username">Username</label>
										<input type="text" name="username" id="username" value="{{ $data->username }}" class="form-control" placeholder="username">
										<p></p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="password">Password</label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
										<span class="toggle-password" onclick="promptAppPassword('password', {{ $data->id }})">
					                      <i class="fa fa-eye"></i>
					                    </span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="key">Key</label>
										<input type="password" class="form-control" name="key" id="key" placeholder="Key">
										<span class="toggle-password" onclick="promptAppPassword('key', {{ $data->id }})">
					                      <i class="fa fa-eye"></i>
					                    </span>
									</div>
								</div>
								<div class="col-md-12">
									  <label for="image">Image (Optional)</label>
									  <div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="image" id="image" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            @if (isset($data->image) && !empty($data->image))
                                            <img id="image_preview" class="img-fluid img-thumbnail" src="{{ getImage(getFilePath('image') . '/' . $data->image) }}" alt="Image preview" style="max-width: 30%; height: auto;">
                                            @else
                                            <img id="image_preview" src="#" alt="Image preview" class="img-fluid img-thumbnail" style="display:none; max-width: 30%; height: auto;">
                                            @endif
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
<div class="modal fade" id="appPasswordModal" tabindex="-1" role="dialog" aria-labelledby="appPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appPasswordModalLabel">Verify App Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="appPassword">Enter App Login Password:</label>
                <input type="password" id="appPassword" class="form-control" placeholder="App Password">
                <input type="hidden" id="recordId" value="">
                <input type="hidden" id="fieldType" value="">
                <p id="passwordError" style="color: red; display: none;">Incorrect password, try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-dark" onclick="verifyAppPassword()">Verify</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
let currentInputId = '';
let currentRecordId = '';
let currentFieldType = '';

function promptAppPassword(inputId, recordId) {
    var passwordInput = $('#' + inputId);
    if (passwordInput.attr('type') === 'password') {
        currentInputId = inputId;
        currentRecordId = recordId;
        currentFieldType = inputId;
        $('#recordId').val(recordId); 
        $('#fieldType').val(inputId); 
        $('#appPasswordModal').modal('show');
    } else {
        togglePasswordVisibility(inputId);
    }
}

function verifyAppPassword() {
    var appPassword = $('#appPassword').val();
    var recordId = $('#recordId').val();
    var fieldType = $('#fieldType').val();

    $.ajax({
        url: '{{ route('admin.app.verifyAppPassword') }}',
        method: 'POST',
        data: {
            password: appPassword,
            id: recordId,
            field_type: fieldType 
        },
        success: function(response) {
            if (response.valid) {
                $('#appPasswordModal').modal('hide');
                $('#' + currentFieldType).val(response.pass);
                togglePasswordVisibility(currentInputId);
            } else {
                $('#passwordError').show();
            }
        },
        error: function() {
            $('#passwordError').show().text('An error occurred, please try again.');
        }
    });
}

function togglePasswordVisibility(inputId) {
    var passwordInput = $('#' + inputId);
    var icon = passwordInput.closest('.input-group').find('.toggle-password i');

    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        passwordInput.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
    $('#appPassword').val('');
    $('#passwordError').hide();
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