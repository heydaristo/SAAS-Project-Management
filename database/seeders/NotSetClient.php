<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotSetClient extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Client::create([
            'user_id' => 1,
            'name' => 'NOTSET',
            'address' => 'NOTSET',
            'no_telp' => 'NOTSET',
            'email' => 'NOTSET'
        ]);
    }
}
