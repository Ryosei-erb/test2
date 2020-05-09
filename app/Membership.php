<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public function user() {
        return $this->belongsTo("App\User");
    }

    public function room() {
        return $this->belongsTo("App\Room");
    }
    protected $guarded = array("id");
    protected $fillable = ["user_id", "room_id"];
}
