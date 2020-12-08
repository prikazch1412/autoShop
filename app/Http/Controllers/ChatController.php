<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Chats;
use App\Models\Messages;

class ChatController extends Controller
{
    function postChat(Request $request) {
        $model1 = Chats::where("user_id_1", $request->user_id)->where("user_id_2", Auth::id());
        $model2 = Chats::where("user_id_1", Auth::id())->where("user_id_2", $request->user_id);
        if($model1->exists() || $model2->exists()) {
            $message = new Messages();
            $message->create([
                "text" => $request->message,
                "user_id" => $request->user_id,
                "chat_id" => $model1->exists() ? $model1['id'] : $model2['id']
            ]);
        } else {
            $chat = new Chats();
            $response = $chat->create([
                "user_id_1" => Auth::id(),
                "user_id_2" => $request->user_id,
            ]);
            $message = new Messages();
            $message->create([
                "text" => $request->message,
                "user_id" => Auth::id(),
                "chat_id" => $response['id']
            ]);
        }
    }

    function getChats() {
        $chats = Chats::with('messages.user')->where("user_id_1", Auth::id())->orWhere("user_id_2", Auth::id())->get();
        foreach ($chats as $key => $chat) {
            $chat->date = Carbon::parse($chat->created_at)->format('d.m.Y H:i');
        }
        return response()->json($chats);
    }

    function postMessages(Request $request, $chat_id) {
        $user = Auth::user();

        $message = new Messages();
        $response = $message->create([
            "text" => $request->message,
            "user_id" => Auth::id(),
            "chat_id" => $chat_id
        ]);

        broadcast(new MessageSentEvent($response, $user, $chat_id))->toOthers();

        return response()->json([
            'message' => $response,
            'user' => $user
        ]);
    }

    function getMessages($chat_id) {
        $result = [];
        $data = Messages::with('user')->where('chat_id', $chat_id)->get();
        foreach ($data as $key => $chat) {
            array_push($result, [
                'message' => $chat,
                'user' => $chat['user']
            ]);
        }
        return response()->json($result);
    }
}
