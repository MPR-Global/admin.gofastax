<?php

namespace App\Http\Controllers;

use App\Models\AirDuctCleaningRules;
use App\Models\DryerVentCleaningRules;
use Illuminate\Http\Request;
use App\Enums\DryerVentExitPointEnum;
use App\Enums\NumberOfFurnaceEnum;
use Illuminate\Support\Facades\Log;
use Mail;

class BusinessRulesController extends Controller
{
    public function index(Request $request)
    {
        $airDuct = AirDuctCleaningRules::get();
        $dryerVent = DryerVentCleaningRules::get();
        return view("business_rules", compact("airDuct","dryerVent"));
    }

    public function create(Request $request)
    {
        return view("add_air_duct_rule")->with('number_of_furnace',NumberOfFurnaceEnum::cases());
    }

    public function save(Request $request)
    {
        $request->validate([
            'num_furnace' => 'required',
            'square_footage_min' => 'required|numeric',
            'square_footage_max' => 'required|numeric',
        ]);
        $userId = auth()->user() ? auth()->user()->id : '';
        $rule = new AirDuctCleaningRules();
        $rule->num_furnace = $request->num_furnace;
        $rule->square_footage_min = $request->square_footage_min;
        $rule->square_footage_max = $request->square_footage_max;
        $rule->furnace_loc_sidebyside = $request->furnace_loc_sidebyside;
        $rule->furnace_loc_different = $request->furnace_loc_different;
        $rule->final_price = $request->final_price;
        $rule->updated_by = $userId;
        $rule->save();
        return redirect("business_rules")->withSuccess('New Air Duct Cleaning Rule added successfully');
    }

    public function edit($id)
    {
        return view('edit_air_duct_rule')->with(['data'=> AirDuctCleaningRules::find($id),'number_of_furnace'=>NumberOfFurnaceEnum::cases()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'num_furnace' => 'required',
            'square_footage_min' => 'required|numeric',
            'square_footage_max' => 'required|numeric',
        ]);
        $rule = AirDuctCleaningRules::find($id);
        $userId = auth()->user() ? auth()->user()->id : '';
        $rule->num_furnace = $request->num_furnace;
        $rule->square_footage_min = $request->square_footage_min;
        $rule->square_footage_max = $request->square_footage_max;
        $rule->furnace_loc_sidebyside = $request->furnace_loc_sidebyside;
        $rule->furnace_loc_different = $request->furnace_loc_different;
        $rule->final_price = $request->final_price;
        $rule->updated_by = $userId;
        $rule->save();
        return redirect("business_rules")->withSuccess('Business Rule updated successfully');
    }

    public function destroy($id)
    {
        $data = AirDuctCleaningRules::find($id);
        $data->delete();
        return redirect("business_rules")->withSuccess('Business Rule deleted successfully');
    }


    public function createDryerVent(Request $request)
    {
        return view("add_dryer_vent_rule")->with("dryerVentExitPoints",DryerVentExitPointEnum::cases());
    }

    public function saveDryerVent(Request $request)
    {
        $request->validate([
            'dryer_vent_exit_point' => 'required|unique:dryer_vent_cleaning_rules',
            'price' => 'required|numeric',
        ]);
        $userId = auth()->user() ? auth()->user()->id : '';
        $rule = new DryerVentCleaningRules();
        $rule->dryer_vent_exit_point = $request->dryer_vent_exit_point;
        $rule->price = $request->price;
        $rule->updated_by = $userId;
        $rule->save();
        return redirect("business_rules")->withSuccess('New Dryer Vent Cleaning Rule added successfully');
    }

    public function editDryerVent($id)
    {
        return view('edit_dryer_vent_rule')->with(["dryerVentExitPoints"=>DryerVentExitPointEnum::cases(),"data"=>DryerVentCleaningRules::find($id)]);
    }

    public function updateDryerVent(Request $request, $id)
    {
        $rule = DryerVentCleaningRules::find($id);
        $userId = auth()->user() ? auth()->user()->id : '';
        $rule->dryer_vent_exit_point = $request->dryer_vent_exit_point;
        $rule->price = $request->price;
        $rule->updated_by = $userId;
        $rule->save();
        return redirect("business_rules")->withSuccess('Dryer Vent Cleaning Rule updated successfully');
    }

    public function destroyDryerVent($id)
    {
        $data = DryerVentCleaningRules::find($id);
        $data->delete();
        return redirect("business_rules")->withSuccess('Dryer Vent Cleaning Rule deleted successfully');
    }
}
