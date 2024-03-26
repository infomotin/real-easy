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
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class PropertyController extends Controller
{
    //PropertyIndex
    public function PropertyIndex()
    {
        //send data to view property.index view
        $properties = Property::orderBy('id','desc')->get();
        return view('backend.property.index',compact('properties'));
    }
    //PropertyAdd
    public function PropertyAdd()
    {
        //send data to view property.index view
        $facilities = Facility::all();
        $pstate = PropertyType::all();
        $amenities = Amenities::all();
        // dd($amenities);
        $activeAgent  = User::where('role','agent')->where('status','active')->get();
        return view('backend.property.add',compact('facilities','pstate','amenities','activeAgent'));
    }
    //PropertyStore
    public function PropertyStore(Request $request)
    {
        // dd($request->all());
        // id generate 
        $pcode = IdGenerator::generate(['table' => 'properties', 'length' => 6, 'prefix' => 'PRO-', 'field' => 'property_code']);

        //amenities 
        $amenities = $request->amenities_id;
        $amenities = implode(",",$amenities);

        //image


        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thambnail/'.$name_gen);
        $save_url = 'upload/property/thambnail/'.$name_gen;

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'property_name' => $request->property_name,
            'property_status' => $request->property_status,
            'property_slug' => strtolower(str_replace('','-',$request->property_name)),
            'amenities_id' => $amenities,
            'property_code' => $pcode,
            'address' => $request->property_address,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms'=> $request->bedrooms,
            'bathrooms'=> $request->bathrooms,
            'garage'=> $request->garage,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'neighborhood' => $request->neighborhood,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'hot' => $request->hot,
            'status' => 1,
            'garage_size' => $request->garage_size,
            'property_thambnail' => $save_url,
            'agent_id' => $request->agent_id,
            'created_by' => Auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        //multi image upload
        $images = $request->file('multi_img');
        foreach($images as $img){
            $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$name_gen);
            $save_url = 'upload/property/multi-image/'.$name_gen;

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $save_url,
                'created_by' => Auth()->user()->id,
                'created_at' => Carbon::now(),
            ]);
        }
        //Facility Store
        $facilities = Count($request->facility_name);
        if($facilities !=null){
            for($i = 0; $i < $facilities; $i++){
                Facility::insert([
                    'property_id' => $property_id,
                    'facility_name' => $request->facility_name[$i],
                    'distance'=> $request->distance[$i],
                    'created_by' => Auth()->user()->id,
                    'status' => 1,
                    'created_by' => Auth()->user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.property.index')->with($notification);
    }
    //PropertyEdit
    public function PropertyEdit($id)
    {
        // findOrFail
        $property = Property::findOrFail($id);
        //send data to view property.index view
        $facilities = Facility::all();
        $pstate = PropertyType::all();
        $amenities = Amenities::all();
        // dd($amenities);
        $activeAgent  = User::where('role','agent')->where('status','active')->get();
        return view('backend.property.edit',compact('property','facilities','pstate','amenities','activeAgent'));
    }
    
}
