<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // RELAZIONE ONE TO MANY CON MODEL Post
    // nella funzione scriviamo al plurale "postS" 
    // perchè la relazione è con più postS
    public function posts() {
        return $this->hasMany("App\Post");
    }
}
