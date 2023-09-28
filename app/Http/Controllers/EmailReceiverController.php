<?php

namespace App\Http\Controllers;

use App\Models\EmailReceivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailReceiverController extends Controller
{
    public function index(Request $request)
    {
        $emails = EmailReceivers::get();
        return view("email_receivers", compact("emails"));
    }


    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $zipcode = new EmailReceivers();
        $zipcode->email = $request->email;
        $zipcode->save();
        return redirect("email_receivers")->withSuccess('New Email added successfully');
    }

    public function destroy($id)
    {
        $data = EmailReceivers::find($id);
        $data->delete();
        return redirect("email_receivers")->withSuccess('Email deleted successfully');
    }

}