<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\PropertyType;
use Illuminate\Support\Str;

class PropertyTypeContorller extends Controller
{
    //PropertyTypeIndex

    public function PropertyTypeIndex()
    {   
        //send data to view propertytype.index view
        $propertytypes = PropertyType::all();
        return view('admin.backend.propertytype.index',compact('propertytypes'));
    }
    //PropertyTypeAdd

    public function PropertyTypeAdd()
    {
        return view('admin.backend.propertytype.add');
    }
    //PropertyTypeStore

    public function PropertyTypeStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'type_name' => 'required|unique:property_types',
            'type_icon' => 'required|unique:property_types',
        ]);

        $propertytype = new PropertyType();
        $propertytype->type_name  = $request->type_name;
        $propertytype->type_icon = $request->type_icon;
        $propertytype->status = 1;
        $propertytype->slug = Str::slug($request->type_name);
        $propertytype->created_by = Auth()->user()->id;
        // dd($propertytype);
        $propertytype->save();
        $notification = array(
            'message' => 'Property Type Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.property-type.index')->with($notification);
    }
    //PropertyTypeEdit

    public function PropertyTypeEdit($id)
    {
        //send data to view
        // dd($id);
        $propertytype = PropertyType::find($id);
        return view('admin.backend.propertytype.edit',compact('propertytype'));
    }
    //PropertyTypeUpdate

    public function PropertyTypeUpdate(Request $request)
    {
        // dd($request->all());
        $propertytype = PropertyType::find($request->id);
        $propertytype->type_name  = $request->type_name;
        $propertytype->type_icon = $request->type_icon;
        // $propertytype->status = 1;
        $propertytype->slug = Str::slug($request->type_name);
        $propertytype->updated_by = Auth()->user()->id;
        // dd($propertytype);
        $propertytype->update();
        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.property-type.index')->with($notification);
    }
}
