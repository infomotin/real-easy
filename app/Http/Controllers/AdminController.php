<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

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
    public function AdminProfileStore(Request $request){
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phonee' => 'required',
        //     'username' => 'required',
        //     'address1' => 'required',
        //     'photo' => 'required',
        // ]);
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->username = $request->username;
        $data->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        // dd($data);
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //AdminChangePassword
    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_change_password',compact('adminData'));
    }
    //AdminUpdateChangePassword
    public function AdminUpdateChangePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        //Match Old Password 
        if(!Hash::check($request->old_password,Auth::user()->password)){
            return redirect()->back()->with("error","Old Password Doesn't match!");
        }
        //Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        return redirect()->back()->with("success","Password Changed Successfully!");
    }
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
