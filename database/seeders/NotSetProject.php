<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotSetProject extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ProjectModel::create([
            'user_id' => 1,
            'id_client' => 1,
            'project_name' => 'NOTSET',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'status' => "ENDED",
        ]);
    }
}
