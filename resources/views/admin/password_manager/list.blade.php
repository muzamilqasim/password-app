@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.app.create') }}" class="btn btn-outline-dark">Add</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    @include('components.notifications')   
    <div class="message"></div>
        <div class="card">
             <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="keyword" id="keyword" class="form-control float-right" placeholder="Search">
                    </div>
                </div>
            </div>
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>App Name</th>                       
                        <th>Action</th>
                    </tr>
                </thead>
                 <tbody id="app-data">
                    @forelse($data as $index => $row)
                    <tr>
                        <td>{{ paginationIndex($data, $index) }}</td>
                        <td>{{ $row->app_name }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('admin.app.show', $row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-warning" href="{{ route('admin.app.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.app.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1" onclick="showDeleteModal(event)">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>  
            <div class="mt-2">
                {{ $data->links('admin.partials.pagination') }}
            </div>                              
        </div>
    </div>
</div>
</section>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="confirmDeleteBtn">Yes</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
       $('#keyword').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: '{{ route('admin.app.search') }}',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                var rows = '';
               var totalWorkHours = 0;
                if (response.status) {
                    $.each(response.data, function(index, row) {
                        rows += '<tr>';
                        rows += '<td>' + ++index  + '</td>';
                        rows += '<td>' + row.app_name  + '</td>';
                        rows += '<td>';
                        rows += '<a class="btn btn-sm btn-outline-success ml-1" href="' + '{{ route('admin.app.show', ':id') }}'.replace(':id', row.id) + '"><i class="fa fa-eye"></i></a>';
                        rows += '<a class="btn btn-sm btn-outline-warning ml-1" href="' + '{{ route('admin.app.edit', ':id') }}'.replace(':id', row.id) + '"><i class="fa fa-pen"></i></a>';
                        rows += '<a href="#" data-destroy="' + '{{ route('admin.app.destroy', ':id') }}'.replace(':id', row.id) + '" class="btn btn-sm btn-outline-danger deleteAction ml-1"><i class="fa fa-trash"></i></a>';
                        rows += '</td></tr>';
                    });
                } else {
                    rows = '<tr><td colspan="7">Record not found.</td></tr>';
                }
                $('#app-data').html(rows);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
    });
</script>
@endpush