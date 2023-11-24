<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Teacher'
            ],
            [
                'name' => 'Student'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
