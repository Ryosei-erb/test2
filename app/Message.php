<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static $rules = array(
        "content" => "required|string"
    );
    public function user() {
      return $this->belongsTo("App\User");
    }

    public function room() {
      return $this->belongsTo("App\Room");
    }

    protected $guarded = array("id");
    protected $fillable = ["user_id", "room_id", "content"];
}
