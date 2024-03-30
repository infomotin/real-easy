@extends('admin.admin_dashboard')
@section('admin')
    {{-- jquery min cdnn  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="page-content">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> Proper Details </h6>
                        <p class="text-muted mb-3">Add class <code>.table</code></p>
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <tbody>
                                    <tr>

                                        <td>Property Name : </td>
                                        <td><code>{{ $property->property_name }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Property Status : </td>
                                        <td> <code>{{ $property->property_status }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Lowest Price: </td>
                                        <td><code>{{ $property->lowest_price }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Max Price : </td>
                                        <td><code>{{ $property->max_price }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>BedRooms: </td>
                                        <td><code>{{ $property->bedrooms }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Bathrooms: </td>
                                        <td><code>{{ $property->bathrooms }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Garage: </td>
                                        <td><code>{{ $property->garage }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Garage Size : </td>
                                        <td><code>{{ $property->garage_size }}</code> Sqr Feet</td>
                                    </tr>
                                    <tr>

                                        <td>Address: </td>
                                        <td><code>{{ $property->address }}</code> </td>
                                    </tr>
                                    <tr>

                                        <td>City: </td>
                                        <td><code>{{ $property->city }}</code> </td>
                                    </tr>
                                    <tr>

                                        <td>State: </td>
                                        <td><code>{{ $property->state }}</code> </td>
                                    </tr>
                                    <tr>

                                        <td>Postal Code: </td>
                                        <td><code>{{ $property->postal_code }}</code> </td>
                                    </tr>
                                    <tr>

                                        <td>Main Thambnail </td>
                                        <td><img src="{{ asset($property->property_thambnail) }}" class="img-fluid square" style="width: 50px; height: 50px;"></td>
                                    </tr>
                                    <tr>

                                        <td>Stauts: </td>
                                        <td>
                                            @if($property->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-warning">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Hoverable Table</h6>
                        <p class="text-muted mb-3">Add class <code>.table-hover</code></p>
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <tbody>
                                    <tr>

                                        <td>Property Code : </td>
                                        <td><code>{{ $property->property_code }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Property Size : </td>
                                        <td> <code>{{ $property->property_size }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Property Video: </td>
                                        <td><code>{{ $property->property_video }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Neighborhood : </td>
                                        <td><code>{{ $property->neighborhood }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Latitude: </td>
                                        <td><code>{{ $property->latitude }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Longitude: </td>
                                        <td><code>{{ $property->longitude }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Property Type : </td>
                                        <td><code>{{ $property->propertyType->type_name }}</code></td>
                                    </tr>
                                    <tr>

                                        <td>Property Amenities: </td>
                                        <td>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                                style="text-color:#dbdbdb" multiple="multiple" data-width="100%">
                                                {{-- {{ $pro_amenity }} --}}
                                                @foreach ($amenities as $ameni)
                                                    <option value="{{ $ameni->id }}"
                                                        {{ in_array($ameni->id, $pro_amenity) ? 'selected' : '' }}>
                                                        {{ $ameni->amenities_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>Agent: </td>
                                        <td><code>
                                            @if($property->agent_id == null)
                                                No Agent
                                            @else
                                                {{ $property['user']['name'] }}
                                            @endif
                                        </code> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            @if($property->status == 1)
                            <form action="{{ route('admin.property.inactive', $property->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <button type="submit" class="btn btn-outline-danger mr-2 mb-2 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0 mb-3 mb-md-0">Inactive</button>
                            </form>
                            @else
                            <form action="{{ route('admin.property.active', $property->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <button type="submit" class="btn btn-outline-success mr-2 mb-2 mb-md-0 mb-lg-0 mb-xl-0 mb-xxl-0 mb-3 mb-md-0">Active</button>
                            </form>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
