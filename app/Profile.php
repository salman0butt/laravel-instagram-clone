<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = [];
    public function getImage() {
        $imagePath = $this->image ?? '/profile/no-image.jpg';
        return '/storage/'.$imagePath;
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
