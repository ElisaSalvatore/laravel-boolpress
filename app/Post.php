<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
   use SoftDeletes;

    protected $fillable = ["title", "content", "slug", "category_id"];

    // RELAZIONE ONE TO MANY CON MODEL User
    public function user() {
        return $this->belongsTo("App\User");
    } 

    // RELAZIONE ONE TO MANY CON MODEL Category
    public function category() {
        return $this->belongsTo("App\Category");
    } 

    // RELAZIONE MANY TO MANY CON MODEL Tag
    public function tags() {
        return $this->belongsToMany("App\Tag");
    } 
}
