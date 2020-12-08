<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\News;
use App\Models\Comments;

class NewsController extends Controller
{

    function getLastNews() {
        $data = News::limit(6)->get();
        return response()->json($data);
    }

    function get() {
        $data = News::get();
        return response()->json($data);
    }

    function post(Request $request) {
        $post = new News();
        $data = $request->all();
        if(gettype($request['photo']) == "object") {
            $name =  "/newsfiles/".uniqid().'.'.$request['photo']->getClientOriginalExtension();
            $request['photo']->move(public_path()."/newsfiles/", $name);
            $data['photo'] = $name;
        }
        $post->create($data);
        return response('ok', 200);
    }

    function update(Request $request, $id) {
        $data = $request->all();
        $model = News::find($id);
        if(gettype($request['photo']) == "object") {
            $name = "/newsfiles/".uniqid().'.'.$request['photo']->getClientOriginalExtension();
            $request['photo']->move(public_path()."/newsfiles/", $name);
            $data['photo'] = $name;
        } else {
            $data['photo'] = $model->photo;
        }
        $model->update($data);
        return response('ok', 200);
    }

    function delete($id) {
        News::find($id)->delete();
        return response('ok', 200);
    }

    function getId($id) {
        $data = News::with('comments.user')->find($id);
        $data['date'] = Carbon::parse($data['created_at'])->format('d.m.Y H:i');
        foreach ($data['comments'] as $key => $item) {
            $item->date = Carbon::parse($item->created_at)->format('d.m.Y H:i');
        }
        return response()->json($data);
    }

    function postComment(Request $request, $id) {
        $model = new Comments();
        $model->create([
            "user_id" => $request->user_id,
            "news_id" => $id,
            "comment" => $request->comment
        ]);
        return response('ok', 200);
    }
}
