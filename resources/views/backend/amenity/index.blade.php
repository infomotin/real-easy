@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('admin.amenitie-type.add') }}" class="btn btn-info">Add New</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Amenities Type List</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amenities Name</th>

                                        <th>Action</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allAmenitie as $key => $propertytype)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $propertytype->amenities_name }}</td>

                                            <td>
                                                <a href="{{ route('admin.amenitie-type.edit', $propertytype->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('admin.amenitie-type.delete', $propertytype->id) }}"
                                                    class="btn btn-danger" id="delete">Delete</a>
                                            </td>
                                            <td>
                                                @if ($propertytype->status == 1)
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
    <script>
        $(function() {
            $(document).on('click', '#delete', function(e) {
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
