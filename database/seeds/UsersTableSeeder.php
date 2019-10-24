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
                'password'           => '$2y$10$MvgmS2ol/gEcczTa1K0cq.Q1uwq.NrtPBvwLXBh3IKQOnkP0B842S',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2019-10-24 20:36:24',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
