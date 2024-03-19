<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        //get auth user
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->last_login = Carbon::now();
        $data->save();

        $notification = array(
            'message' => 'User: '.Auth::user()->username.' Login Successfully!',
            'alert-type' => 'info'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN)->with($notification);
        }elseif (Auth::user()->role ==='agent') {
            return redirect()->intended(RouteServiceProvider::AGENT)->with($notification);
        }else{
            return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
