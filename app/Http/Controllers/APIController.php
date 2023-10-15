<?php

namespace App\Http\Controllers;

use App\Models\AirDuctCleaningRules;
use App\Models\DryerVentCleaningRules;
use App\Models\Zipcodes;
use Illuminate\Http\Request;
use App\Enums\DryerVentExitPointEnum;
use App\Enums\NumberOfFurnaceEnum;
use Mail;

class APIController extends Controller
{
    function getBusinessRules(Request $request)
    {
        $airDuct = AirDuctCleaningRules::get();
        $dryerVent = DryerVentCleaningRules::get();
        $exitPoints = DryerVentExitPointEnum::cases();
        $numFurnaces = NumberOfFurnaceEnum::cases();
        return response()->json(array("airDuct" => $airDuct, "dryerVent" => $dryerVent, "exitPoints" => $exitPoints, "numFurnaces" => $numFurnaces));
    }

    function getZipdata(Request $request)
    {
        $zipData = Zipcodes::select("id", "zipcode", "city", "county", "coverage", "additional_price", "duration_from_amistee", "distance_from_amistee")->where("zipcode", $request->zipcode)->first();
        if ($zipData) {
            return response()->json(array("message" => "Zip Found", "data" => $zipData));
        }
        return response()->json(array("message" => "Zipcode Not Found", "data" => $zipData));
    }
}
