<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\UserHasServices;
use App\Models\UserHasServiceItems;
use App\Models\UserPhoto;
use App\Models\Reviews;
use App\Models\UserCars;
use App\Models\Favorites;
use App\Models\ServiceCars;

use App\Models\ServiceItems;
use App\Models\Models;
use App\Models\City;
use App\Models\News;

class UserController extends Controller
{
    protected $fileStorage = "userfiles/";

    function home() {
        $serviceItems = ServiceItems::with('service')->get();
        $models = Models::with('series')->get();
        $city = City::get();
        $popularServices = User::with(
            'services.service',
            'serviceItems.item',
            'photos'
        )->where("user_role_id", 2)->orWhere("user_role_id", 3)->limit(6)->get();
        $lastNews = News::limit(6)->get();

        return response()->json([
            "servicesItems" => $serviceItems,
            "cars" => $models,
            "city" => $city,
            "popularServices" => $popularServices,
            "lastNews" => $lastNews
        ]);
     }

    // updateUser
    function updateUser(Request $request, $id) {
        User::find($id)->update([
            "status" => $request->status
        ]);
        return response('ok', 200);
     }

    // getUsers
    function getUsers() {
       $data = User::with("userRole")->where('user_role_id', '!=', 4)->get();
        return response()->json($data);
    }

    // delFavorites
    function delFavorites($id) {
        Favorites::where("user_id", Auth::id())->where('favorite_user_id', $id)->delete();
        return response('ok', 200);
    }

    // getFavorites
    function getFavorites() {
        $data = Favorites::with('user.photos')->where("user_id", Auth::id())->get();
        return response()->json($data);
    }

    // postFavorites
    function postFavorites(Request $request) {
        $model = new Favorites();
        $model->create([
            "user_id" => Auth::id(),
            "favorite_user_id" => $request->user_id
        ]);
        return response('ok', 200);
    }

    //getPopularServices
    function getPopularServices() {
        $data = User::with(
            'services.service',
            'serviceItems.item',
            'photos'
        )->where("user_role_id", 2)->orWhere("user_role_id", 3)->limit(6)->get();
        return response()->json($data);
    }

    //postUserCar
    function postUserCar(Request $request) {
        $model = new UserCars();
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $model->create($data);
        return response('ok', 200);
    }

    //delUserCar
    function delUserCar($id) {
        UserCars::find($id)->delete();
        return response('ok', 200);
    }

    //postReview
    function postReview(Request $request, $id) {
        $model = new Reviews();
        $model->create([
            "user_id" => $id,
            "client_id" => Auth::id(),
            "comment" => $request->comment
        ]);
        return response('ok', 200);
    }

    //delReview
    function delReview($id) {
        Reviews::find($id)->delete();
        return response('ok', 200);
    }

    //getServices
    function getServices(Request $request) {
        $model = User::with('services.service', 'serviceItems.item', 'photos', 'favorites', 'serviceCars')->whereNotIn('user_role_id', [1, 4]);
        if($request->services != "") {
            $model->whereHas('serviceItems.item', function($query) use ($request) {
                $query->where('service_item_id', "=", $request->services);
            });
        }
        if($request->cars != "") {
            $model->whereHas('serviceCars', function ($query) use ($request) {
                $query->where('model_id', $request->cars);
            });
        }
        if($request->city != "") {
            $model->where('city_id', $request->city);
        }
        if($request->title != "") {
            $model->where('name', $request->title)->orWhere('surname', $request->title)->orWhere('service_name', $request->title);
        }

        if($request->user_roles != "") {
            $model->whereIn('user_role_id', $request->user_roles);
        }

        $data = $model->get();
        return response()->json($data);
    }

    //getServiceId
    function getServiceId($id) {
        $data = User::with('services.service', 'serviceItems.item', 'photos', 'reviews.user', 'favorites', 'serviceCars.car')->find($id);
        foreach ($data['reviews'] as $key => $value) {
            $value['date'] = Carbon::parse($value['created_at'])->format('d.m.Y');
        }
        return response()->json($data);
    }

    //profile
    function profile() {
        $data = User::with(
            'services.service',
            'serviceItems.item',
            'photos',
            'orders.user',
            'reviews.user',
            'cars',
            'serviceCars.car'
        )->find(Auth::id());
        foreach ($data['orders'] as $key => $value) {
            $value['date'] = Carbon::parse($value['created_at'])->format('d.m.Y');
            $value['car'] = json_decode($value['car']);
            $value['services'] = json_decode($value['services']);
        }
        return response()->json($data);
    }

    // updateUser
    function updateProfile(Request $request) {
        $id = Auth::id();
        $data = $request->all();
        if(isset($data['newPassword'])) {
            $user = Auth::user();
            if (Hash::check($data['oldPassword'], $user->password)) {
                $data["password"] = Hash::make($request->newPassword);
            } else {
                return response('error', 401);
            }
        }
        if($request->services) {
            UserHasServices::where("user_id", $id)->delete();
            UserHasServiceItems::where("user_id", $id)->delete();
            foreach ($request->services as $key => $value) {
                $model = new UserHasServices();
                $model->create([
                    "user_id" => $id,
                    "service_id" => $value['id']
                ]);
                foreach ($value['items'] as $k => $v) {
                    if($v['selected'] == 1) {
                        $modelItem = new UserHasServiceItems();
                        $modelItem->create([
                            "user_id" => $id,
                            "service_item_id" => $v['id'],
                            "price" => isset($v['price']) ? $v['price'] : null
                        ]);
                    }
                }
            }
        }

        if($request->cars) {
            ServiceCars::where("user_id", $id)->delete();
            foreach ($request->cars as $key => $value) {
                $model = new ServiceCars();
                $model->create([
                    "user_id" => $id,
                    "model_id" => $value['id']
                ]);
            }
        }
        User::find($id)->update($data);
        return response()->json(User::with('services.service', 'serviceItems.item')->find($id));
    }

    // postProfilePhoto
    function postProfilePhoto(Request $request) {
        $uploadedFiles = $request->pics;
        foreach ($uploadedFiles as $file) {
            $model = new UserPhoto();
            $puth = $this->fileStorage.Auth::id();
            $name = 'http://'.$_SERVER['HTTP_HOST'].'/'.$puth."/".uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/'.$puth, $name);
            $model->create([
                "user_id" => Auth::id(),
                "src" => $name
            ]);
        }
        return response('ok', 200);
    }

    // delProfilePhoto
    function delProfilePhoto($id) {
        UserPhoto::find($id)->delete();
        return response('ok', 200);
    }

    // img Account
    function img(Request $request) {
        if(isset($request['photo'])) {
            $arr = [];
            if($request['photo']) {
                $file = uniqid().'_photo_min.png';
                $uploadfile = $this->fileStorage . $request['id'] . '/' . $file;

                $img = str_replace('data:image/png;base64,', '', $request['photo']);
                $img = str_replace(' ', '+', $img);
                $fileData = base64_decode($img);
                file_put_contents(public_path().'/'.$uploadfile, $fileData);

                $arr['status'] = 'success';
                $arr['path_mini'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$uploadfile;
                $arr['file_mini'] = $file;
            }
        }
        else {
            if(!file_exists("userfiles/".$request['id'])) {
                mkdir($this->fileStorage.$request['id']);
            }
            $uploadfile = $this->fileStorage. $request['id'] . '/' . uniqid().'_photo_original.png';
            $arr = array();
            if (move_uploaded_file($_FILES['file']['tmp_name'], public_path().'/'.$uploadfile)) {
                $arr['status'] = 'success';
                $arr['path_max'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$uploadfile;
                $arr['file_max'] = $_FILES['file']['name'];
            } else {
               $arr['status'] = 'fail';
            }
        }
        header('Content-type: application/json');
        return response()->json($arr);
    }
}
