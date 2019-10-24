<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => '$2y$10$ijKh9vZmvpyJ0E7/LRXGwOQ9dhJfmYfxT5R1.sz5UVlOh4O.q3RNK',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2019-10-24 20:56:18',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
