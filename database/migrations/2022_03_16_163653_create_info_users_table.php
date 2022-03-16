<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_users', function (Blueprint $table) {
            $table->id();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("avatar")->nullable();

            // Creo FK con la tabella Users
            $table->unsignedBigInteger("user_id"); // creo la colonna FK nella tabella info_user
            $table->foreign("user_id")  // indico che è una FK
            ->references("id") //  che fa riferimento alla colonna id
            ->on("users"); // della tabella users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_users');
    }
}
