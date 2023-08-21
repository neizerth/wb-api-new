<?php

namespace App\Console\Commands;

use App\Components\WBAPI;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $api = new WBAPI();

        $dateFrom = now()->format('Y-m-d');

        $response = $api->request('/api/sales', [
            'dateFrom' => $dateFrom,
        ]);

        var_dump($response);
    }
}
