<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatesUserIdColumnInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('posts', function (Blueprint $table) {
            //  e lo setta su false: quindi imposta l'user_id come un campo obbligatorio
            // Mettiamo il change() perchè stiamo modificando una colonna già esistente
            $table->unsignedBigInteger("user_id")
                ->nullable(false)
                ->change();
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
            // In questo modo annullo il nullable impostato precentemente : infatti se è true lo elimina
            $table->unsignedBigInteger("user_id")->nullable(true)->change();
        });
    }
}
