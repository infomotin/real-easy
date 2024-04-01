@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('admin.property.add') }}" class="btn btn-info">Add New Agent</a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Agent List</h6>
                    
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status Type</th>
                                    <th>Change</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $propertytype)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($propertytype->photo) }}" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $propertytype->name }}</td>
                                    <td>{{ $propertytype->role }}</td>
                                    <td>
                                        @if($propertytype->status =='active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($propertytype->status =='inactive')
                                            <span class="badge bg-warning">Inactive</span>
                                        @elseif($propertytype->status=='reject')
                                            <span class="badge bg-danger">Reject</span>
                                        @elseif($propertytype->status=='obs')
                                            <span class="badge bg-info">Obs</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.user.status.change', $propertytype->id) }}" method="post">
                                            @csrf
                                            <select name="status" id="status" class="form-control">
                                                <option value="active" {{ $propertytype->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $propertytype->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                <option value="reject" {{ $propertytype->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                                <option value="obs" {{ $propertytype->status == 'obs' ? 'selected' : '' }}>Obs</option>
                                            </select>
                                            <button type="submit" class="btn btn-success">Change</button>
                                        </form>
                                    </td>


                                    <td>{{ $propertytype->last_login }}</td>
                                    <td>
                                        <a href="{{ route('admin.property.view', $propertytype->id) }}" class="btn btn-info"><i data-feather="eye"></i></a>
                                        <a href="{{ route('admin.property.edit', $propertytype->id) }}" class="btn btn-info"><i data-feather="edit"></i></a>
                                        <a href="{{ route('admin.property.delete', $propertytype->id) }}" class="btn btn-danger" id="delete"><i data-feather="trash-2"></i></a>
                                    </td>
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(function(){
$(document).on('click','#delete',function(e){
    console.log("hello");
    e.preventDefault();
    var link = $(this).attr("href");  
              Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = link
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
              }) 


});

});
</script>
@endsection