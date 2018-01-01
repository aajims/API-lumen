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
        factory(\App\Models\User\UserModel::class)->create([
            'email'    => 'lumen@qq.com',
            'password' => app('hash')->make('lumen'),
        ]);

        factory(\App\Models\User\UserModel::class)->create([
            'email'    => 'phalcon@qq.com',
            'password' => app('hash')->make('phalcon'),
        ]);

        factory(\App\Models\User\UserModel::class)->create([
            'email'    => 'symfony@qq.com',
            'password' => app('hash')->make('symfony'),
        ]);

        factory(\App\Models\User\UserModel::class)->create([
            'email'    => 'laravel@qq.com',
            'password' => app('hash')->make('laravel'),
        ]);
    }
}
