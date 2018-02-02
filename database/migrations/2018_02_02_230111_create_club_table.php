<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateClubTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('club', function (Blueprint $table) {
            $table->increments('id_club');
            $table->string('nom_club');
            $table->string('url_club');
            $table->string('nom_ville');
            $table->enum('pays',['France','Espagne', 'Allemagne', 'Italie', 'Angleterre']);
            $table->string('acronyme')->unique();
            $table->string('nom_image')->unique();
            $table->timestamps(); /* ajoute la date de creation et modification */
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('club');
    }
}