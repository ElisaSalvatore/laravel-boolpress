<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use App\Traits\SlugGenerator;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller {
    use SlugGenerator;

    public function index(Request $request) {
        // filtrare i dati
        $filter = $request->input("filter");

        // paginazione
        if($filter) {
            $posts = Post::where("title", "LIKE", "%$filter%")->paginate(4);
        } else {
            $posts = Post::paginate(4);
        }
    
        // Per poter leggere e stampare in Vue i dettagli dello user 
        $posts->load("user", "category", "tags");

        //Ciclo la collection di dati 
        $posts->each(function($post) {
            //se il post ha una coverImg, allora sostituisco il valore con l'URl
            // completo per quell'immagine
            if($post->coverImg) {
                $post->coverImg = asset("storage/" . $post->coverImg);
            } else {
                $post->coverImg = 'https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126.png';
            }
        });

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

    public function destroy($slug) {
        $post = Post::where("slug", $slug)->first;

        $post->tags()->detach();

        if($post->coverImg) {
            Storage::delete($post->coverImg);
        }

        $post->delete();

        return redirect()->route("admin.posts.index");
    }
}
