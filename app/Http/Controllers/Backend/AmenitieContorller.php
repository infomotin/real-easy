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
        return view('backend.amenity.index',compact('allAmenitie'));
    }
    // AmenityAdd

    public function AmenityAdd()
    {
        return view('backend.amenity.add');
    }
    //AmenityStore

    public function AmenityStore(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:amenities',
        ]);
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
            'status' => 1,
            'created_by' => Auth()->user()->id,
            'created_at' => now(),
        ]);
        $notification = array(
            'message' => 'Amenity Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.amenitie-type.index')->with($notification);

    }
    //AmenityEdit

    public function AmenityEdit($id)
    {
        $amenitie = Amenities::find($id);
        return view('backend.amenity.edit',compact('amenitie'));
    }
    //AmenityUpdate

    public function AmenityUpdate(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:amenities',
        ]);
        Amenities::find($request->id)->update([
            'amenities_name' => $request->amenities_name,
            'status' => 1,
            'updated_by' => Auth()->user()->id,
            'updated_at' => now(),
        ]);
        $notification = array(
            'message' => 'Amenity Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.amenitie-type.index')->with($notification);

    }
    //AmenityDelete

    public function AmenityDelete($id)
    {
        Amenities::find($id)->delete();
        $notification = array(
            'message' => 'Amenity Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.amenitie-type.index')->with($notification);
    }
}
