<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OfferGenerateFromApi
{
    public static function generateDataFromApi(Client $client, $apiKey, $size, $dateFrom, $order ){
       Log::info("[OfferGenerateFromApi:generateDataFromApi]: Generowanie list ofert z żadania restowego");
       Log::debug("[OfferGenerateFromApi:generateDataFromApi]: Parametry żądania : key = $apiKey, size = $size, dateFrom = $dateFrom, size = $size ");
       $response = $client->request("GET",'/api/v2.0/offers',
       ['query' => [
             'key' => $apiKey,
             'size' => $size,
             'dateFrom' => $dateFrom,
             'order' => $order
        ],
           'headers' => [
               'User-Agent' => 'JobTask/1.0',
               'Accept'     => 'application/json'
           ]
           ]);
       return json_decode($response->getBody()->getContents())->items;
    }
}