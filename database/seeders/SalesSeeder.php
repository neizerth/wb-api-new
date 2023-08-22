<?php

namespace Database\Seeders;

use App\Components\WBAPI;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $api = new WBAPI();

//        $dateFrom = now()->format('Y-m-d');
        $dateFrom = '1990-01-01';
//        $dateFrom = '2024-01-01';

        $api->iterate('/api/sales', [
            'dateFrom' => $dateFrom,
        ], function ($response) {
            $data = $response['data'];
            $this->onData($data);

            return false;
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function onData($data) {
        var_dump($data);
    }
}
