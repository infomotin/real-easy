<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Property;
// use App\Models\Backend\Property;
use App\Models\Backend\PropertyType;
use App\Models\Backend\Amenities;
use App\Models\Backend\Facility;
use App\Models\User;
use App\Models\Backend\MultiImage;


use Illuminate\Support\Str;


class PropertyController extends Controller
{
    //PropertyIndex
    public function PropertyIndex()
    {
        //send data to view property.index view
        $properties = Property::orderBy('id','desc')->get();
        return view('admin.backend.property.index',compact('properties'));
    }
    //PropertyAdd
    public function PropertyAdd()
    {
        //send data to view property.index view
        $facilities = Facility::all();
        $propertytypes = PropertyType::all();
        $amenities = Amenities::all();
        $agent = User::where('role','status')->where('status','active')->get();
        return view('admin.backend.property.add',compact('facilities','propertytypes','amenities','agent'));
    }
    //PropertyStore
    
}
