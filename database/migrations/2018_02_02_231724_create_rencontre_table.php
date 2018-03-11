<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRencontreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencontre', function (Blueprint $table) {
            $table->increments('id_match');
            $table->string('division');
            $table->integer('annee');
            $table->string('date', 10);
            $table->integer('equipe_domicile');
            $table->integer('equipe_exterieur');
            $table->integer('but_domicile');
            $table->integer('but_exterieur');
            $table->string('resultat');
            $table->integer('but_mitemps_domicile');
            $table->integer('but_mitemps_exterieur');
            $table->string('resultat_mitemps');
            $table->string('nom_arbitre')->nullable();
            $table->integer('tir_domicile');
            $table->integer('tir_exterieur');
            $table->integer('tirCadre_domicile');
            $table->integer('tirCadre_exterieur');
            $table->integer('HF');
            $table->integer('AF');
            $table->integer('corner_domicile');
            $table->integer('corner_exterieur');
            $table->integer('cartonJaune_domicile');
            $table->integer('cartonJaune_exterieur');
            $table->integer('cartonRouge_domicile');
            $table->integer('cartonRouge_exterieur');

            //$table->foreign('division')->references('acronyme')->on('competition');
            //$table->foreign('equipe_domicile')->references('id_club')->on('club');
            //$table->foreign('equipe_exterieur')->references('id_club')->on('club');

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
        Schema::dropIfExists('rencontre');
    }
}
