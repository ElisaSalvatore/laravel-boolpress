<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // RELAZIONE MANY TO MANY CON MODEL Post
    public function posts() {
        return $this->belongsToMany("App\Post");
    } 
}
