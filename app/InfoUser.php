<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
   // RELAZIONE ONE TO ONE CON MODEL User
   public function user() {
        return $this->belongsTo("App\User");
    } 
}