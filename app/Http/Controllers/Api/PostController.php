<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Http\Request;

class PostController extends Controller {
    use SlugGenerator;

    public function index() {
        $posts = Post::paginate(4);

        // Per poter leggere e stampare in Vue i dettagli dello user 
        $posts->load("user", "category", "tags");

        // Ritornare i dati tramite JSON
        return response()->json($posts);
    }

    public function store(Request $request) {
        $data = $request->validate([
            "title"=> "required|min:5",
            "content"=> "required|min:20",
            "category_id"=> "nullable",
            "tags" => "nullable",
        ]);

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->user_id = 1;
        $newPost->slug = $this->generateUniqueSlug($data["title"]);
        $newPost->save();

        // Per salvare anche i tags devo fare un attach. Va sempre dopo il save.
        if(key_exists("tags", $data)){
            $newPost->tags()->attach($data["tags"]);
        }

        return response()->jason($newPost);
    }

    public function show($slug) {
        $post = Post::where("slug", $slug)
        ->with([ "tags", "user", "category"])
        ->first();

        if (!$post) {
            abort(404);
        }

        return response()->json($post);
    }
}
