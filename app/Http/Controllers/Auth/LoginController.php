<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        // return $request->input();

        // Validate the login data
            $request->validate([
                'login_email' => 'required|email',
                'password' => 'required',
            ]);
            // Perform the login
            $credentials = $request->only('login_email', 'password');
            if (auth()->attempt(['email' => $credentials['login_email'], 'password' => $credentials['password']])) {
                // Authentication successful

                toastr()->success('Login Successfully', 'Success');


                return redirect()->route('admin.dashboard'); // Change 'dashboard' to your actual dashboard route
            }
            toastr()->error('Invalid login credentials');
            // toastr()->error(['login_email' => 'Invalid email credentials', 'password' =>'Invalid password credentials'], 'Error');
            // Authentication failed
            return redirect()->back();
            // return redirect()->back()->withErrors(['login_email' => 'Invalid email credentials', 'password' =>'Invalid password credentials']);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        toastr()->success('Logout successfully');
        return redirect('/');
    }



}
