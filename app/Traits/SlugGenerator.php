<?php
namespace App\Traits;

use App\Post;
use Illuminate\Support\Str;

trait SlugGenerator {
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

?>