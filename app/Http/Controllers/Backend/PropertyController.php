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
        $properties = Property::orderBy('id', 'desc')->get();
        return view('backend.property.index', compact('properties'));
    }
    //PropertyAdd
    public function PropertyAdd()
    {
        //send data to view property.index view
        $facilities = Facility::all();
        $pstate = PropertyType::all();
        $amenities = Amenities::all();
        // dd($amenities);
        $activeAgent  = User::where('role', 'agent')->where('status', 'active')->get();
        return view('backend.property.add', compact('facilities', 'pstate', 'amenities', 'activeAgent'));
    }
    //PropertyStore
    public function PropertyStore(Request $request)
    {
        // dd($request->all());
        // id generate 
        $pcode = IdGenerator::generate(['table' => 'properties', 'length' => 6, 'prefix' => 'PRO-', 'field' => 'property_code']);

        //amenities 
        $amenities = $request->amenities_id;
        $amenities = implode(",", $amenities);

        //image


        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'property_name' => $request->property_name,
            'property_status' => $request->property_status,
            'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
            'amenities_id' => $amenities,
            'property_code' => $pcode,
            'address' => $request->property_address,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
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
        foreach ($images as $img) {
            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $name_gen);
            $save_url = 'upload/property/multi-image/' . $name_gen;

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $save_url,
                'created_by' => Auth()->user()->id,
                'created_at' => Carbon::now(),
            ]);
        }
        //Facility Store
        $facilities = Count($request->facility_name);
        if ($facilities != null) {
            for ($i = 0; $i < $facilities; $i++) {
                Facility::insert([
                    'property_id' => $property_id,
                    'facility_name' => $request->facility_name[$i],
                    'distance' => $request->distance[$i],
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
        //amenities 
        $amenities =  $property->amenities_id;
        $pro_amenity = explode(',', $amenities);
        // dd($pro_amenity);
        $facilities = Facility::where('property_id', $id)->get();
        $pstate = PropertyType::all();
        $amenities = Amenities::latest()->get();
        // send multi image 
        $mult_images = MultiImage::where('property_id', $id)->get();
        // dd($amenities);
        // dd($facilities);
        $activeAgent  = User::where('role', 'agent')->where('status', 'active')->get();
        return view('backend.property.edit', compact('property', 'facilities', 'pstate', 'amenities', 'activeAgent', 'pro_amenity', 'mult_images'));
    }
    //PropertyUpdate
    public function PropertyUpdate(Request $request)
    {
        $id = $request->id;
        Property::findOrFail($id)->update([
            'ptype_id' => $request->ptype_id,
            'property_name' => $request->property_name,
            'property_status' => $request->property_status,
            'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
            'amenities_id' => $request->amenities_id,

            'address' => $request->property_address,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
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

            'agent_id' => $request->agent_id,
            'updated_by' => Auth()->user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.property.index')->with($notification);
    }
    //PropertyThambnailUpdate
    public function PropertyThambnailUpdate(Request $request)
    {
        $property = $request->id;;
        $old_image = $request->old_image;

        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;
        if (file_exists($old_image)) {
            unlink($old_image);
        }

        Property::findOrFail($property)->update([
            'property_thambnail' => $save_url,
            'updated_by' => Auth()->user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Thambnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // PropertyMultiImageUpdate
    public function PropertyMultiImageUpdate(Request $request)
    {
        $property = $request->id;
        //multi image upload
        $images = $request->multi_image;
        // dd($images);
        foreach ($images as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            if (file_exists($imgDel->photo_name)) {
                unlink($imgDel->photo_name);
            }
            // dd($imgDel->photo_name);
            // unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_by' => Auth()->user()->id,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //PropertyMultiImageDelete
    public function PropertyMultiImageDelete($id)
    {
        $old_image = MultiImage::findOrFail($id);
        if (file_exists($old_image->photo_name)) {
            unlink($old_image->photo_name);
        }
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // PropertyMultiImageNewStore
    public function PropertyMultiImageNewStore(Request $request)
    {
        // find properti id 
        $pro_id = $request->image_id;
        $image = $request->file('multi_image');
        if (count($image) > 0) {
            foreach ($image as $multi_image) {
                $make_name = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
                Image::make($multi_image)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
                $uploadPath = 'upload/property/multi-image/' . $make_name;
                MultiImage::insert([
                    'property_id' => $pro_id,
                    'photo_name' => $uploadPath,
                    'created_by' => Auth()->user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $notification = array(
            'message' => 'Property Multi Image Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //PropertyFacilityUpdate
    public function PropertyFacilityUpdate(Request $request)
    {
        $property = $request->id;
        // dd( $request->id);
        $property_facility = $request->facility_name;
        $facility_dis = $request->distance;
        // dd($property_facility,$facility_dis);
        if ($property_facility == null) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $property)->delete();
            $facility_count = count($property_facility);
            if ($facility_count != null && $facility_count != 0) {
                for ($i = 0; $i < $facility_count; $i++) {
                    $fcount = new Facility();
                    $fcount->property_id = $property;
                    $fcount->facility_name = $property_facility[$i];
                    $fcount->distance = $facility_dis[$i];
                    $fcount->save();
                }
            }
            $notification = array(
                'message' => 'Property Facility Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
