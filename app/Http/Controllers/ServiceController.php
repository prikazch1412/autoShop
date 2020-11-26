<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\ServiceItems;

class ServiceController extends Controller
{
    function get() {
        $data = Services::with('items')->get();
        return response()->json($data);
    }
    function getItems() {
        $data = ServiceItems::get();
        return response()->json($data);
    }
}
