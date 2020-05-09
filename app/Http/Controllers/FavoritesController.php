<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request) {
      Favorite::create(["user_id" => Auth::user()->id, "product_id" => $request->product_id]);
      return redirect("/products/" . $request->product_id);
    }

    public function update(Request $request, $id) {
      $favorite = Favorite::find($id);
      $favorite->delete();
      return redirect("/products/" . $request->product_id);
    }
}
