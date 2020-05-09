<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function messages() {
      return $this->hasMany("App\Message");
    }
    public function memberships() {
      return $this->hasMany("App\Membership");
    }
    public function product() {
      return $this->belongsTo("App\Product");
    }

    protected $guarded = array("id");
    protected $fillable = ["product_id"];
}
