<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }
    //AdminProfile
    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }
    //AdminLogin
    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
