<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create() {
        $categories = Category::all();
        
        return view("posts.create", compact("categories"));
    }
}
