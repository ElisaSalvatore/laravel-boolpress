<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["code"=> "thriller", "description"=> "descrizione thriller "],
            ["code"=> "comedy", "description"=> "descrizione comica"],
            ["code"=> "action", "description"=> "descrizione d'azione"],
            ["code"=> "adventure", "description"=> "descrizione d'avventura"],
            ["code"=> "romance", "description"=> "descrizione romantica"],
        ];

        foreach ($categories as $category) {
            $newCat = new Category();

            // In alternativa posso usare il FILL(), nel caso in cui ci siano molti più dati da passare tornerebbe sicuramente utile:
            // $newCat->code = $category["code"];
            // $newCat->description = $category["description"];
            $newCat->fill($category);
            $newCat->save();

            // Altro modo con cui posso creare una nuova categoria:
            // Category::create($category);
        }
    }
}
