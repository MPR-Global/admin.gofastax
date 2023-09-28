<?php

namespace App\Http\Controllers;

use App\Models\Zipcodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;

class ZipcodesController extends Controller
{
    public function index(Request $request)
    {
        $zipcodes = Zipcodes::get();
        return view("zipcodes", compact("zipcodes"));
    }

    public function create(Request $request)
    {
        return view("add_zipcode");
    }

    public function save(Request $request)
    {
        $request->validate([
            'zipcode' => 'required|numeric',
            'city' => 'required|string',
            'county' => 'required|string',
            'coverage' => 'required',
            'additional_price' => 'required|numeric',
        ]);
        $zipcode = new Zipcodes();
        $zipcode->zipcode = $request->zipcode;
        $zipcode->city = $request->city;
        $zipcode->county = $request->county;
        $zipcode->coverage = $request->coverage;
        $zipcode->additional_price = $request->additional_price;
        $zipcode->save();
        return redirect("zipcodes")->withSuccess('New Zipcode added successfully');
    }

    public function edit($id)
    {
        return view('edit_zipcode')->with('data', Zipcodes::find($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'zipcode' => 'required|numeric',
            'city' => 'required|string',
            'county' => 'required|string',
            'coverage' => 'required',
            'additional_price' => 'required|numeric',
        ]);
        $zipcode = Zipcodes::find($id);
        $zipcode->zipcode = $request->zipcode;
        $zipcode->city = $request->city;
        $zipcode->county = $request->county;
        $zipcode->coverage = $request->coverage;
        $zipcode->additional_price = $request->additional_price;
        $zipcode->save();
        return redirect("zipcodes")->withSuccess('Zipcode updated successfully');
    }

    public function destroy($id)
    {
        $data = Zipcodes::find($id);
        $data->delete();
        return redirect("zipcodes")->withSuccess('Zipcode deleted successfully');
    }
}
