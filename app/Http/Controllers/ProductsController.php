<?php

namespace App\Http\Controllers;

use App\Product;
use App\Membership;
use App\Room;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use GoogleMaps;

class ProductsController extends Controller
{
    public function index(Request $request) {
        $products = Product::all();

        return view("product.index", ["products" => $products]);
    }

    public function show($id) {
        $product = Product::find($id);
        if ($product->state == "sold") return redirect("/products/" . $product->id . "/sold");

        //ダイレクトメッセージ機能
        $user = $product->user;
        $room_id = [];
        if (Auth::check()):
            $memberships = Membership::where("user_id", Auth::user()->id)->get();
            foreach ($memberships as $membership):
                if ($membership->room->product_id == $product->id):
                    $room_id = $membership->room_id;
                endif;
            endforeach;
        endif;
        //お気に入り機能
        $favorite = [];
        if (Auth::check()):
            $favorite = Favorite::where("user_id", Auth::user()->id)->where("product_id", $product->id)->first();
        endif;

        //Gooogle Maps機能
        $json = GoogleMaps::load('geocoding')->setParam(["address" => $product->address])->get();
        $geo = json_decode($json, true);
        $lat = $geo["results"][0]["geometry"]["location"]["lat"];
        $lng = $geo["results"][0]["geometry"]["location"]["lng"];

        return view("product.show", ["product" => $product, "user" => $user, "room_id" => $room_id, "favorite" => $favorite, "lat" => $lat, "lng" => $lng, "geo" => $geo]);
    }

    public function create() {
        return view("product.create");
    }

    public function store(Request $request) {
        $this->validate($request, Product::$rules);
        $product = new Product;

        $filename = $request->file("image")->getClientOriginalName();
        $img = Image::make($request->file("image"));
        $img->resize(500,500)->save( public_path() . "/images/" . $filename);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->pickup_times = $request->pickup_times;
        $product->price = $request->price;
        $product->image = $filename;
        $product->address = $request->address;
        $product->user_id = Auth::user()->id;
        $product->save();
        return redirect("/products");
    }

    public function sold($id) {
        $product = Product::find($id);
        $product->state = "sold";
        $product->save();
        return view("product.sold", ["product" => $product]);
    }

    public function resale($id) {
        $product = Product::find($id);
        $product->state = "sale";
        $product->save();
        return redirect("/products/" . $product->id);
    }

}
