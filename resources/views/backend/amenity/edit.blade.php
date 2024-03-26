@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Amenitie Type</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Amenitie Type</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form action="{{ route('admin.amenitie-type.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $amenitie->id }}">
                        <div class="row mb-3">
                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">amenitie Type Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('amenities_name') is-invalid @enderror"
                                    name="amenities_name" id="amenities_name" placeholder="Enter amenitie Type Name" value="{{ $amenitie->amenities_name }}">
                                @error('amenities_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary px-5">Edit Amenitie Type</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!--end page wrapper -->
@endsection
