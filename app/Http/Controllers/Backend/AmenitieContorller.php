<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Amenities;

class AmenitieContorller extends Controller
{
    //AmenityIndex

    public function AmenityIndex()
    {
        $allAmenitie = Amenities::all();
        return view('admin.backend.amenity.index',compact('allAmenitie'));
    }
}
