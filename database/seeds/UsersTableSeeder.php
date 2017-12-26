<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email'    => 'lumen@qq.com',
            'password' => app('hash')->make('lumen'),
        ]);

        factory(\App\User::class)->create([
            'email'    => 'phalcon@qq.com',
            'password' => app('hash')->make('phalcon'),
        ]);

        factory(\App\User::class)->create([
            'email'    => 'symfony@qq.com',
            'password' => app('hash')->make('symfony'),
        ]);

        factory(\App\User::class)->create([
            'email'    => 'laravel@qq.com',
            'password' => app('hash')->make('laravel'),
        ]);
    }
}
