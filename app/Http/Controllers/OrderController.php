<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Orders;

class OrderController extends Controller
{
    // postOrder
    function postOrder(Request $request, $id) {
        $model = new Orders();
        $model->create([
            "comment" => $request->comment,
            "client_id" => Auth::id() ? Auth::id() : null,
            "time" => $request->time,
            "user_id" => $id,
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "car" => json_encode($request->car),
            "services" => json_encode($request->services)
        ]);
        return response('ok', 200);
    }
    // updateOrder
    function updateOrder($id) {
        Orders::find($id)->update([
            "status" => 1
        ]);
        return response('ok', 200);
    }
    // delOrder
    function delOrder($id) {
        Orders::find($id)->delete();
        return response('ok', 200);
    }
}
