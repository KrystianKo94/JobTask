<?php

namespace App\Singletons;

use GuzzleHttp\Client;

class RestApiConnection
{
    private static $client;


    public function __construct()
    {
        self::$client = new Client(['base_uri' => env("WROCLAW_BASE_URL")]);
    }

 
    public static function getClient(): Client
    {
        if(self::$client == null){
            new RestApiConnection();
        }
        return self::$client;
    }

}