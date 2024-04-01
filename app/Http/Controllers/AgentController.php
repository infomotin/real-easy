<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;

class AgentController extends Controller
{
    public function AgentDashboard(){
        return view('agent.index');
    }
    //AgentLogin
    public function AgentLogin(){
        return view('agent.agent_login');
    }
    //AgentRegister
    public function AgentRegister(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'phone' => ['required', 'string', 'max:255'],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'agent',
            'status' => 1,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
    }
    // AgentProfile
    public function AgentProfile(){
        $id = Auth::user()->id;
        $agent = User::find($id);
        return view('agent.agent_profile_view',compact('agent'));
    }
    // AgentProfileStore
    public function AgentProfileStore(Request $request){
        $id = Auth::user()->id;
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
            'message' => 'Agent Profile Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //AgentChangePassword
    public function AgentChangePassword(){
        $id = Auth::user()->id;
        $agent = User::find($id);
        return view('agent.agent_change_password',compact('agent'));
    }
    // AgentPasswordUpdate
    public function AgentPasswordUpdate(Request $request){
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
    //AgentLogout
    public function AgentLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Agent Logout Successfully!',
            'alert-type' => 'success'
        );
        return redirect('/agent/login')->with($notification);
    }

}
