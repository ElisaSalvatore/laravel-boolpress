<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // FOREIGN KEY USER
            // La tabella si chiama "users" ma nella creazione della colonna uso il singolare "user_id"
            // perchè all'interno della colonna ci sarà un solo id che rappresenterà un solo utente
            $table->unsignedBigInteger("user_id")
            ->nullable()
            ->after("slug");
            
            $table->foreign("user_id") // Indico quale colonna è una foreign key
                ->references("id") // Devo specificare a quale COLONNA fa rifeirmento la foreign key
                ->on("users");  // colonna id della TABELLA users

            // FOREIGN KEY CATEGORY con versione abbreviata
            $table->foreignId("category_id")
                ->nullable() //un post potrebbe non avere una categoria associata, è opzionale.
                ->after("user_id")
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Prima scolleghiamo la FK
            $table->dropForeign("posts_user_id_foreign");
            // Ora è possibile cancellare la colonna
            $table->dropColumn("user_id");

            $table->dropForeign("posts_category_id_foreign");
            $table->dropColumn("category_id");
        });
    }
}
