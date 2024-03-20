<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // client
        \App\Models\Client::create([
            'user_id' => 1,
            'name' => 'NOTSET',
            'address' => 'NOTSET',
            'no_telp' => 'NOTSET',
            'email' => 'NOTSET'
        ]);

        // project
        \App\Models\ProjectModel::create([
            'user_id' => 1,
            'id_client' => 1,
            'project_name' => 'NOTSET',
            'start_date' => '2021-01-01',
            'end_date' => '2021-12-31',
            'status' => "ENDED",
        ]);

        // invoices
        \App\Models\Invoice::create([
            'id_project' => 1,
            'id_client' => 1,
            'issued_date' => '2021-01-01',
            'due_date' => '2021-12-31',
            'status' => "PAID",
            'total' => 0,
            'invoice_pdf' => 'NOTSET',
            'user_id' => 1,
        ]);

        // contract
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

        // quotation
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


        // plan
        $plans = [
            [
                'plan_name' => 'Free',
                'price' => 0,
                'benefits' => '
                5 Clients
                Standart Tools
                Standart Contract',
            ],
            [
                'plan_name' => 'Premium',
                'price' => 100000,
                'benefits' =>
                    'No Pop Up Ads Premium
                Unlimited Client
                Editable Contract',
            ],
        ];

        foreach ($plans as $plan) {
            \App\Models\Plan::create($plan);
        }





    }
}
