<?php

namespace Database\Seeders;

use App\Components\WBAPI;
use App\Models\Sale;
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
        $dateTo = '2024-01-01';

        $api->iterate('/api/sales', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ], function ($response) {
            sleep(1);
            $data = $response['data'];
            $this->onData($data);

//            return false;
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function onData($data) {
        $count = count($data);

        echo "got $count items\n";
        foreach ($data as $saleData) {
            $this->seedItem($saleData);
        }
//        var_dump($data);
    }

    public function seedItem($item) {

        $sale = Sale::query()
            ->where('sale_id', '=', $item['sale_id'])
            ->first();

        if (!$sale) {
            $sale = new Sale;
        }

        $sale->fill($item);

        $sale->save();
    }
}
