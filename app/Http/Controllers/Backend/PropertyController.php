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
        // dd($amenities);
        $agent = User::where('role','status')->where('status','active')->get();
        return view('admin.backend.property.add',compact('facilities','propertytypes','amenities','agent'));
    }
    //PropertyStore
    public function PropertyStore(Request $request)
    {
        // dd($request->all());
        $property = new Property();
        $property->property_name = $request->property_name;
        $property->property_type = $request->property_type;
        $property->property_price = $request->property_price;
        $property->property_address = $request->property_address;
        $property->property_latitude = $request->property_latitude;
        $property->property_longitude = $request->property_longitude;
        $property->property_description = $request->property_description;
        $property->status = $request->status;
        $property->save();

        $property_id = $property->id;

        $property->amenities()->attach($request->amenities);
        $property->facility()->attach($request->facility);
        $property->agent()->attach($request->agent);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            foreach ($image as $multi_image) {
                $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
                $image->move(public_path('upload/multi_images'),$name_gen);
                $final_name = 'upload/multi_images/'.$name_gen;
                MultiImage::insert([
                    'property_id' => $property_id,
                    'image' => $final_name,
                ]);
            }
        }

        $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.property.index')->with($notification);

    }
    
}
