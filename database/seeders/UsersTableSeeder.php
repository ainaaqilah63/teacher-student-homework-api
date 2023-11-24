<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $teacherRole = Role::where('name', 'Teacher')->pluck('id')->first();
        $studentRole = Role::where('name', 'Student')->pluck('id')->first();

        $users = [
            [
                'name' => 'Aina Aqilah',
                'role_id' => $studentRole->id,
                'username' => 'aaina',
                'password' => bcrypt('password123'),
                'email' => 'ainaaqilah@gmail.com',
                'phone_no' => '0123456789'
            ],
            [
                'name' => 'Letchumy a/p Subramaniam',
                'role_id' => $studentRole->id,
                'username' => 'letchumy',
                'password' => bcrypt('password456'),
                'email' => 'amalamathi@gmail.com',
                'phone_no' => '0126534273'
            ],
            [
                'name' => 'Ng Kyli',
                'role_id' => $studentRole->id,
                'username' => 'ngkyli',
                'password' => bcrypt('password789'),
                'email' => 'kyli.ng@gmail.com',
                'phone_no' => '0164735283'
            ],
            [
                'name' => 'Hidayah Ishak',
                'role_id' => $teacherRole->id,
                'username' => 'hidayah',
                'password' => bcrypt('password024'),
                'email' => 'hidayah.ishak@gmail.com',
                'phone_no' => '0174583920'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
