<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GenerateNameCategory
{
    public static function getCategoriesByIds(Client $client,$apiKey ,$masterIds,$lang){
        Log::info("[OfferGenerateFromApi:generateDataFromApi]: Generowanie list ofert z żadania restowego");
        Log::debug("[OfferGenerateFromApi:generateDataFromApi]: Parametry żądania : key = $apiKey, masterIds = $masterIds, lang = $lang");
        $response = $client->request("GET",'/api/v2.0/offers/categories',
            ['query' => [
                'key' => $apiKey,
                'masterIds' => $masterIds,
                'lang' => $lang
            ],
                'headers' => [
                    'User-Agent' => 'Homework/1.0',
                    'Accept'     => 'application/json'
                ],
            ],
        );
        $content = $response->getBody()->getContents();
        Log::debug("[OfferGenerateFromApi:generateDataFromApi]: ".$content);
        return json_decode($content);
    }
}
