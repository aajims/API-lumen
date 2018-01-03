<?php

use App\Models\User\UserModel;
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
        factory(UserModel::class)->create([
            'email'    => 'lumen@qq.com',
            'password' => 'lumen',
        ]);

        factory(UserModel::class)->create([
            'email'    => 'phalcon@qq.com',
            'password' => 'phalcon',
        ]);

        factory(UserModel::class)->create([
            'email'    => 'symfony@qq.com',
            'password' => 'symfony',
        ]);

        factory(UserModel::class)->create([
            'email'    => 'laravel@qq.com',
            'password' => 'laravel',
        ]);
    }
}
