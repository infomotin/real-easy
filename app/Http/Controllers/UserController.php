<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function Index()
    {
        return view('forntend.index');
    }
    //UserProfile

    public function UserProfile()
    {
        $id = Auth()->user()->id;
        $userData = User::find($id);
        return view('forntend.dashboard.edit_profile', compact('userData'));
    }
    //UserProfileStore

    public function UserProfileStore(Request $request)
    {
        //validation

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->first_name = $request->first_name; 
        $data->least_name = $request->least_name;
        $data->phone = $request->phone;
        $data->city = $request->city;
        $data->district = $request->district;
        $data->post_code = $request->post_code;
        $data->division = $request->division;
        $data->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }
        // dd($data);
        $data->save();
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //UserChangePassword

    public function UserChangePassword()
    {   
        $id = Auth()->user()->id;
        $userData = User::find($id);
        return view('forntend.dashboard.user_change_password', compact('userData'));
    }
    //UserPasswordUpdate
    public function UserPasswordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
       
        if(!Hash::check($request->old_password,auth::user()->password)){
            // dd($request->old_password);
            $notification = array(
                'message' => 'Old Password Doesn\'t match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
            
        }
        //Update the new Password
        User::whereId(auth::user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        // dd($request->all());
        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    //UserLogout
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User Logout Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }
}
