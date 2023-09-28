<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangepasswordController extends Controller
{
    public function index()
    {
        return view('changepassword');
    }

    public function changepassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password successfully changed!');
    }
}
