<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MemberEmail;
use Illuminate\Support\Facades\Mail;

use App\Models\Orders;
use App\Models\User;

class OrderController extends Controller
{
    function getOrders() {
        $data = Orders::with('user')->get();
        return response()->json($data);
    }

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

        $textMessage = 'Нова заявка на ремонт авто. <a href="' . $_SERVER['SERVER_NAME'] . '/profile/orders/">Перейти в кабінет</a>';

        $user = User::find($id);
        $email = $user['email'];

        Mail::send([], [], function($message) use ($textMessage, $email) {
            $message->to($email)
            ->subject('Нова заявка на ремонт авто')
            ->from('mykhaylo.otroshchenko@student.sumdu.edu.ua', 'STO')
            ->setBody($textMessage, 'text/html');
        });

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
