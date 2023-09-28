<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth/login');
    }

    public function checklogin(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('business_rules')
                ->withSuccess('Signed in');
        } else {
            return redirect()->route('login')
                ->withErrors(['msg' => 'Invalid credentials. Please try again']);
        }
    }
    public function registerUser()
    {
        return view('addUser');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("users")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'user_name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function signOut()
    {
        // dd('hi');
        Auth::logout();
        Session::flush();
        return Redirect('login');
    }

}
