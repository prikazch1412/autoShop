<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Models;
use App\Models\Series;

class CarController extends Controller
{
    function getCars() {
        $data = Models::with('series')->get();
        return response()->json($data);
    }

    function getSeries() {
        $data = Series::get();
        return response()->json($data);
    }
}
