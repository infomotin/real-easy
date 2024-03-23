@extends('admin.admin_dashboard')
@section('admin')
    {{-- add jquery cdn  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Property</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Property</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Property</h6>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" class="form-control" name="property_name">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select class="form-select mb-3" name="property_status" id="property_status">
                                                <option selected="" disabled="">Select Status</option>
                                                <option value="1">For Rent</option>
                                                <option value="2">For Sale</option>
                                                <option value="3">For Rental</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price</label>
                                            <input type="text" class="form-control" name="lowest_price"
                                                id="lowest_price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Prices</label>
                                            <input type="text" class="form-control" name="max_price" id="max_price">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Thambnail</label>
                                            <input type="file" class="form-control" name="property_thambnail"
                                                id="property_thambnail" onchange="mainThamUrl(this)">
                                            <img src="" id="mainThmb" alt="" style="margin: 4px">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Multiple Image </label>
                                            <input type="file" class="form-control" name="multi_img[]" id="multiImg"
                                                multiple="">
                                            <div class="row" id="preview_img"> </div>    
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <!-- Col -->
                                </div>
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">BedRooms</label>
                                            <input type="text" name="bedrooms" id="bedrooms" class="form-control" placeholder="Enter city">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" name="bathrooms" id="bathrooms" class="form-control" placeholder="Enter state">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" name="garage" id="garage" class="form-control" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage Size</label>
                                            <input type="text" name="garage_size" id="garage_size" class="form-control" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter city">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">city</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter state">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">	state</label>
                                            <input type="text" name="state" id="state" class="form-control" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">postal Code</label>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    <!-- Col -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" name="property_size" id="property_size" class="form-control" placeholder="Enter city">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Neighborhood</label>
                                            <input type="text" name="neighborhood" id="neighborhood" class="form-control" placeholder="Enter state">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" name="property_video" id="property_video" class="form-control" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                    
                                    <!-- Col -->
                                </div>

                                <!-- Row -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">latitude</label>
                                            <input type="text" name="latitude" id="latitude" class="form-control" >
                                            <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank" rel="noopener noreferrer">Example</a>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">longitude</label>
                                            <input type="text" class="form-control" name="longitude" id="longitude"
                                                >
                                        </div>
                                    </div><!-- Col -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select name="property_type" id="property_type" class="form-select">
                                                <option selected="" disabled="">Select Property Type</option>
                                                @foreach($propertytypes as $key => $propertytype)
                                                <option value="{{ $propertytype->id }}">{{ $propertytype->type_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">amenities</label>
                                            <select name="amenities[]" id="amenities" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                                @foreach($amenities as $amenitie)
                                                <option value="{{ $amenitie->id }}" >{{ $amenitie->amenities_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Agent</label>
                                            <select name="agent_id" id="agent_id" class="form-select">
                                                <option selected="" disabled="">Select Property Type</option>
                                                @foreach($agent as $key => $a)
                                                <option value="{{ $a->id }}">{{ $a->name  }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Col -->
                                </div>
                                <!-- Row -->
                            </form>
                            <button type="button" class="btn btn-primary submit">Submit form</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    amenities_name: {
                        required: true,
                    },

                },
                messages: {
                    amenities_name: {
                        required: 'Please Enter amenities name',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    {{-- //mainThamUrl  --}}
    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                            .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                    img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
    <!--end page wrapper -->
@endsection
