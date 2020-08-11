<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
            'name'    => 'Автор неизвестен',
            'email'   => 'unknoledge_autor.g',
            'password' =>bcrypt('пароль')
            ],
            [
            'name'    => 'Автор',
            'email'   => 'autor.g',
            'password' =>bcrypt('123123')
            ]
    ];
    DB::table('users')->insert($data);

    }
}
//php artisan migrate:refresh --seed