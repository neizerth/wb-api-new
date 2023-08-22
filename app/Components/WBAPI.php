<?php

namespace App\Components;

use GuzzleHttp\Client;

class WBAPI {
    // новый клиент API
    public function getClient() {
        // Хост API
        $baseUri = config('services.wb.host');

        $client = new Client([
            'base_uri' => $baseUri
        ]);

        return $client;
    }

    public function request($path, $data = []) {
        $client = $this->getClient();

        $key = config('services.wb.key');

        $queryString = array_merge_recursive($data, [
            'key' => $key
        ]);

        try {
            $response = $client->request('GET', $path, [
                'query' => $queryString
            ]);
        }
        catch (\Exception $e) {
            return [];
        }

        $json = $response->getBody()->getContents();

        $data = json_decode($json, true);

        return $data;
    }

    public function iterate($path, $data, $onData) {
        $page = 1;

        while(true) {
            echo "getting data at page: $page\n";
            $paginatedData = array_merge_recursive($data, [
                'page' => $page
            ]);

            $response = $this->request($path, $paginatedData);
            $dataResponse = $onData($response);

            if ($dataResponse === false) {
                return;
            }

            $link = $response['links']['next'] ?? null;

            if (!$link) {
                return;
            }

            $page++;
        }
    }
}
