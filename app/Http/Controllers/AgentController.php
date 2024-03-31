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
