<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = array("id");
    protected $table = "products";
    protected $fillable = ["name", "description", "pickup_times", "price", "user_id", "image", "address"];
    public static $rules = array(
      "name" => "required|string|",
      "description" => "required|string",
      "pickup_times" => "required|string",
      "price" => "required|integer",
    );

    public function user() {
      return $this->belongsTo("App\User");
    }

    public function room() {
      return $this->hasOne("App\Room");
    }

    public function favorites() {
      return $this->hasMany("App\Favorite");
    }

}
