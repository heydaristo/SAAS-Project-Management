<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'role_name' => 'superadmin',
        ]);

        \App\Models\Role::create([
            'role_name' => 'admin',
        ]);
        
        \App\Models\Role::create([
            'role_name' => 'user',
        ]);
    }
}
