<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
// use auth;

class AdminController extends Controller
{
    // UserIndex
    public function UserIndex(){
        $users = User::where('role','agent')->get();
        return view('backend.agentuser.user_index',compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    //UserStatusChange
    public function UserStatusChange(Request $request, $id){
        $findUser = User::find($id);
        $findUser->status = $request->status;
        $findUser->save();
        $notification = array(
            'message' => 'User Status Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }
    //AddAgent
    public function AddAgent(){
        return view('backend.agentuser.add_agent');
    }
    //StoreAgent
    public function StoreAgent(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            // 'username' => 'required',
            'address' => 'required',
            'photo' => 'required',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        // $data->username = $request->username;
        $data->address = $request->address;
        $data->status = 'active';
        $data->role = 'agent';
        $data->password = Hash::make($request->password);
        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'),$filename);
            $data['photo'] = $filename;
        }   
        // dd($data);
        $data->save();
        $notification = array(
            'message' => 'Agent Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.user.index')->with($notification);
    }
    //EditAgent
    public function EditAgent($id){
        $agent = User::find($id);
        return view('backend.agentuser.edit_agent',compact('agent'));
    }
    //UpdateAgent
    public function UpdateAgent(Request $request, $id){
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.user.index')->with($notification);

    }
    //DeleteAgent
    public function DeleteAgent($id){
        $data = User::find($id);
        @unlink(public_path('upload/agent_images/'.$data->photo));
        $data->delete();
        $notification = array(
            'message' => 'Agent Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    public function AdminDashboard(){
        return view('admin.index');
    }

    //changeStatus
    public function changeStatus(Request $request){
        $data = User::find($request->user_id);
        $data->status = $request->status;
        $data->save();
        return response()->json(['success'=>'Status change successfully.']);
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
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Admin Logout Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/admin/login')->with($notification);
    }
}
