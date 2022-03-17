<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "slug", "category_id"];

    // RELAZIONE ONE TO MANY CON MODEL User
    public function user() {
        return $this->belongsTo("App\User");
    } 

    // RELAZIONE ONE TO MANY CON MODEL Category
    public function category() {
        return $this->belongsTo("App\Category");
    } 
}
