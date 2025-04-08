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
    <div class="container-fluid">
    <div class="message"></div>
        <div class="card">
        <div class="card-body table-responsive">                                 
            <table class="table">
                <tr>
                    <th colspan="2">App Name:</th>
                    <td colspan="2">{{ $data->app_name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $data->email ?? '' }}</td>
                    <th>Username:</th>
                    <td>{{ $data->username ?? '' }}</td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td>
                        <div class="col-md-12">
                            <input type="password" id="password" class="form-control-plaintext" value="{{ $data->password ?? '' }}" readonly>
                            <span class="toggle-password" onclick="promptAppPassword('password', {{ $data->id }})">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </td>
                    <th>Key:</th>
                    <td>
                        <div class="col-md-12">
                            <input type="password" id="key" class="form-control-plaintext" value="{{ $data->key ?? '' }}" readonly>
                            <span class="toggle-password" onclick="promptAppPassword('key', {{ $data->id }})">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>
                @if(!empty($data->image))
                <tr>
                    <th colspan="2">Image:</th>
                    <td colspan="2">
                        <img src="{{ getImage(getFilePath('image') . '/' . $data->image) }}" class="img-fluid img-thumbnail" alt="Image preview" style="height:250px;">
                    </td>
                </tr>
                @endif
            </table>                      
        </div>
    </div>
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
</script>
