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
            $table->string('login');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('avatar_url')->default('STATS&CO/default_imgs/img-usr-default.jpg');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday');
            $table->rememberToken();
            $table->timestamps();  /* ajoute la date de creation et modification */
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}