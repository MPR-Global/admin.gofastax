<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function addUser()
    {
        return view('addUser');
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required',
        ]);

        $admin = new User;
        $admin->user_name = $request->user_name;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->is_super_admin = $request->is_super_admin? $request->is_super_admin : 0;
        $admin->is_active = $request->has('is_active');
        //$admin->is_representative = $request->;
        // $admin->group_id = $request->uname;
        $admin->save();
        return redirect("users")->withSuccess('New User added successfully');
    }

    public function index()
    {
        return view('users')->with('data', User::all());
    }

    public function edit($id)
    {
        return view('editUser')->with('data', User::find($id));
    }

    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        $admin->user_name = $request->user_name;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->is_super_admin = $request->is_super_admin;
        $admin->is_active = $request->has('is_active');
        //$admin->is_representative = $request->;
        // $admin->group_id = $request->uname;
        $admin->save();
        return redirect("users")->withSuccess('User updated successfully');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect("users")->withSuccess('User deleted successfully');
    }

}
