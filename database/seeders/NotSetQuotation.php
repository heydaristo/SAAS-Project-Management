<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotSetQuotation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Quotation::create([
            'id_user' => 1,
            'id_client' => 1,
            'id_project' => 1,
            'quotation_name' => 'NOTSET',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'status' => "ENDED",
            'quotation_pdf' => 'NOTSET',
        ]);
    }
}
