<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotSetContract extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Contract::create([
            'id_user' => 1,
            'id_client' => 1,
            'id_project' => 1,
            'contract_name' => 'NOTSET',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'contract_pdf' => 'NOTSET',
            'status' => "ENDED",
        ]);
        
    }
}
