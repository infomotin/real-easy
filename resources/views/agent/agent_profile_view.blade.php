
@extends('agent.agent_dashboard')
@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">

        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="position-relative">
                        <figure class="overflow-hidden mb-0 d-flex justify-content-center">
                            <img src="https://via.placeholder.com/1560x370"class="rounded-top" alt="profile cover">
                        </figure>
                        <div
                            class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
                            <div>
                                <img class="wd-80 rounded-circle"
                                src="{{ !empty($agent->photo) ? url('upload/agent_images/' . $agent->photo) : url('/upload/no_image.jpg') }}"
                                alt="profile">
                                <span class="h4 ms-3 text-dark">{{ $agent->name }}</span>
                            </div>
                            <div class="d-none d-md-block">
                                <button class="btn btn-primary btn-icon-text">
                                    <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-3 rounded-bottom">
                        <ul class="d-flex align-items-center m-0 p-0">
                            <li class="d-flex align-items-center active">
                                <i class="me-1 icon-md text-primary" data-feather="columns"></i>
                                <a class="pt-1px d-none d-md-block text-primary" href="#">Timeline</a>
                            </li>
                            <li class="ms-3 ps-3 border-start d-flex align-items-center">
                                <i class="me-1 icon-md" data-feather="user"></i>
                                <a class="pt-1px d-none d-md-block text-body" href="#">About</a>
                            </li>
                            <li class="ms-3 ps-3 border-start d-flex align-items-center">
                                <i class="me-1 icon-md" data-feather="users"></i>
                                <a class="pt-1px d-none d-md-block text-body" href="#">Friends <span
                                        class="text-muted tx-12">3,765</span></a>
                            </li>
                            <li class="ms-3 ps-3 border-start d-flex align-items-center">
                                <i class="me-1 icon-md" data-feather="image"></i>
                                <a class="pt-1px d-none d-md-block text-body" href="#">Photos</a>
                            </li>
                            <li class="ms-3 ps-3 border-start d-flex align-items-center">
                                <i class="me-1 icon-md" data-feather="video"></i>
                                <a class="pt-1px d-none d-md-block text-body" href="#">Videos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">

                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">

                            <div>
                                <img class="wd-100 rounded-circle"
                                    src="{{ !empty($agent->photo) ? url('upload/agent_images/' . $agent->photo) : url('/upload/no_image.jpg') }}"
                                    alt="profile">
                                <span class="h4 ms-3">{{ $agent->name }}</span>
                            </div>

                        </div>
                        <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of
                            Social.</p>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">{{ $agent->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $agent->phone }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $agent->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                            <p class="text-muted">{{ $agent->name }}</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body" >
                                {{-- @csrf --}}
                                <h6 class="card-title">Agent Form</h6>
                                <form class="forms-sample" method = "POST" action ={{ route('agent.profile.store') }} enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" value="{{ $agent->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $agent->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $agent->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Address </label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $agent->address }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">Photo </label>
                                        <input type="file" class="form-control" id="image" name="photo">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label"></label>
                                        <img class="wd-80 rounded-circle" id="showImage"
                                        src="{{ !empty($agent->photo) ? url('upload/agent_images/' . $agent->photo) : url('/upload/no_image.jpg') }}"
                                        alt="User">
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button class="btn btn-secondary">Cancel</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->

        </div>

    </div>


 <script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
