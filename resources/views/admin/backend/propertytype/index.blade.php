@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('admin.property-type.add') }}" class="btn btn-info">Add New</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Type List</h6>
                        
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Type Name</th>
                                        <th>Type Icon</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($propertytypes as $key => $propertytype)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $propertytype->type_name }}</td>
                                        <td>{{ $propertytype->type_icon }}</td>
                                        <td>
                                            <a href="{{ route('admin.property-type.edit', $propertytype->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ route('admin.property-type.delete', $propertytype->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                        </td>
                                        <td>
                                            @if($propertytype->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-warning">Inactive</span>
                                            @endif
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
@endsection
