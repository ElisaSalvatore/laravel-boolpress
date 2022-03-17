<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title"=> "required|min:5",
            "content"=> "required|min:20",
        ]);
        
        // dd($data);

        $post = new Post();
        $post->fill($data);

        // Creazione di SLUG UNICI
        // necessario importare manualmente use Illuminate\Support\Str; a inizio pagina

        // Genero lo slug partendo dal titolo
        $slug = Str::slug($post->title);
        // Controllo a database se esiste già un elemento con lo stesso slug
        $exists = Post::where("slug", $slug)->first();
        $counter = 1; //si crea il counter per incrementare lo slug nel caso in cui 
        //se ne dovrebbe creare uno con uno slug già esistente.

        // Se uno Slug creato dovesse già esistere eseguo il while):
        while($exists) {
            // Genero un nuovo Slug prendendo quello precedente e concatenando un numero incrementale
            $newSlug = $slug . "-" . $counter;
            $counter++;
            // Controllo a database se esiste già un elemento con il nuovo slug appena esagerato
            $exists = Post::where("slug", $newSlug)->first();

            // Se non esiste, salvo il nuovo slug nella variabile $slug che verrà poi 
            //usata per assegnare il valore all'interno del nuovo post.
            if(!$exists) {
                $slug = $newSlug;
            }
        }

        // Assegno il valore di slug al nuovo post
        $post->slug = $slug;

        // Per recuperare l'id dell'utente loggato
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route("admin.posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // uso where() perche con l'independent injection è possibile passare solamente $id, ma noi stiamo passando lo $slug
        $post = Post::where("slug", $slug)->first(); 

        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->first();
        // Per recuperare i dati della tabella categories da db
        $categories = Category::all();

        // Al return vado a passare due variabili (array)
        return view("admin.posts.edit", [
            "post" => $post,
            "categories" => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "title"=> "required|min:5",
            "content"=> "required|min:20",
            "category_id" => "nullable",
        ]);
        $post = Post::findOrFail($id);

        // Se l'utente modifica il titolo del post, di conseguenza cambia anche lo slug:
        // in questo caso viene generato un nuovo slug!  
        if($data["title"]!== $post->title) {

            // // Genero lo slug partendo dal titolo
            // $slug = Str::slug($data["title"]);
            // // Controllo a database se esiste già un elemento con lo stesso slug
            // $exists = Post::where("slug", $slug)->first();
            // $counter = 1; //si crea il counter per incrementare lo slug nel caso in cui 
            // //se ne dovrebbe creare uno con uno slug già esistente.

            // // Se uno Slug creato dovesse già esistere eseguo il while):
            // while($exists) {
            //     // Genero un nuovo Slug prendendo quello precedente e concatenando un numero incrementale
            //     $newSlug = $slug . "-" . $counter;
            //     $counter++;
            //     // Controllo a database se esiste già un elemento con il nuovo slug appena esagerato
            //     $exists = Post::where("slug", $newSlug)->first();

            //     // Se non esiste, salvo il nuovo slug nella variabile $slug che verrà poi 
            //     //usata per assegnare il valore all'interno del nuovo post.
            //     if(!$exists) {
            //         $slug = $newSlug;
            //     }
            // }

            // $post->slug = $slug; //oppure in alternativa:
            // $data["slug"] = $slug;

            $data["slug"] = $this->generateUniqueSlug($data["title"]);
        }
        
        $post->update($data);

        // return redirect()->route("admin.posts.show", $post->$id);
        return redirect()->route("admin.posts.show", $post->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // FUNZIONE DELLO SLUG con l'obiettivo di non ripetere codice uguale
    protected function generateUniqueSlug($postTitle) {
        // Genero lo slug partendo dal titolo
        $slug = Str::slug($postTitle);
        // Controllo a database se esiste già un elemento con lo stesso slug
        $exists = Post::where("slug", $slug)->first();
        $counter = 1; //si crea il counter per incrementare lo slug nel caso in cui 
        //se ne dovrebbe creare uno con uno slug già esistente.

        // Se uno Slug creato dovesse già esistere eseguo il while):
        while($exists) {
            // Genero un nuovo Slug prendendo quello precedente e concatenando un numero incrementale
            $newSlug = $slug . "-" . $counter;
            $counter++;
            // Controllo a database se esiste già un elemento con il nuovo slug appena esagerato
            $exists = Post::where("slug", $newSlug)->first();

            // Se non esiste, salvo il nuovo slug nella variabile $slug che verrà poi 
            //usata per assegnare il valore all'interno del nuovo post.
            if(!$exists) {
                $slug = $newSlug;
            }
        }

        return $slug;
    }
}
