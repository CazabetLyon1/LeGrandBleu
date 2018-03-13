<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accounts_image_id')->unsigned()->default(1);
            $table->integer('club_id')->unsigned()->nullable();
            $table->string('login');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday');
            $table->rememberToken();
            $table->timestamps();  /* ajoute la date de creation et modification */

            //Foreign key
            $table->foreign('accounts_image_id')
                ->references('id')
                ->on('accounts_images')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //Foreign key
            $table->foreign('club_id')
                ->references('id_club')
                ->on('club')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_accounts_image_id_foreign');
            $table->dropForeign('users_club_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}