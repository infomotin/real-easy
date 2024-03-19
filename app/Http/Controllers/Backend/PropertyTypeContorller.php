<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\PropertyType;

class PropertyTypeContorller extends Controller
{
    //PropertyTypeIndex

    public function PropertyTypeIndex()
    {   
        //send data to view propertytype.index view
        $propertytypes = PropertyType::all();
        return view('admin.backend.propertytype.index',compact('propertytypes'));
    }
}
