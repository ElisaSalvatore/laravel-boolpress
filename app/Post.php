<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "slug"];

    // RELAZIONE ONE TO MANY CON MODEL User
   public function user() {
    return $this->belongsTo("App\User");
} 
}
