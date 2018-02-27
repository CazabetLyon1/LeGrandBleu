<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class accountsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/default_imgs/img-usr-default.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr2.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr3.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr4.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr5.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr6.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr7.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr8.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr9.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr10.jpg',
        ]);
        DB::table('accounts_images')->insert([
            'avatar_url' => 'STATS&CO/usrs_imgs/img-usr11.jpg',
        ]);
    }
}
