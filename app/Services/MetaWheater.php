<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class MetaWheater
{
    /**
     * function getWheater()
     * 
     * @param string $city name of city
     * @return array $return of result in array
     * 
     */
    public static function getWheater($city){
        $client = new Client;
        $result = $client->request('GET', 'https://www.metaweather.com/api/location/search/?query='.$city);
        $body = $result->getBody()->getContents();
        $body = json_decode($body, TRUE);
        if ($body === NULL){
            return 'not found';
        }
        return self::week($body[0]['woeid']);
    }

    /**
     * function week()
     * to find weather forecast in a week (6 days from now)
     * 
     * @param integer Where On Earth ID, based on getWheater() woeid if found
     * @return array a set array of result and assets for weather icon
     */
    private static function week($woeid){
        $client = new Client;
        $result = $client->request('GET', 'https://www.metaweather.com/api/location/'.$woeid);
        $result = $result->getBody()->getContents();
        return json_decode($result, TRUE);
    }
}