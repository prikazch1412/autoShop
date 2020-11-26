<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\City;

class CityController extends Controller
{
    function getRegions() {
        $data = Region::with('city')->get();
        return response()->json($data);
    }

    function getCity() {
        $data = City::get();
        return response()->json($data);
    }
}
