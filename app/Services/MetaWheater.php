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
    public static function getWeather($city){
        $client = new Client;
        $result = $client->request('GET', config('constants.META_WEATHER.QUERY_URL').$city);
        $body = $result->getBody()->getContents();
        $body = json_decode($body, TRUE);
        if (empty($body)){
            return 'not found';
        }
        return self::week($body[0]['title'], $body[0]['woeid']);
    }

    /**
     * function week()
     * to find weather forecast in a week (6 days from now)
     * 
     * @param string $city, city name
     * @param integer $woeid, Where On Earth ID, based on getWeather() woeid if found
     * @return array a set array of result and assets for weather icon
     */
    private static function week($city, $woeid){
        $client = new Client;
        $result = $client->request('GET', config('constants.META_WEATHER.WOEID_URL').$woeid);
        $result = $result->getBody()->getContents();
        $array_result = json_decode($result, TRUE);
        $weather_a_week = $array_result['consolidated_weather'];
        
        // data rendering
        $data = [];
        foreach ($weather_a_week AS $key=>$value){
            $data[$key]['city'] = $city;
            $data[$key]['temperature'] = round($value['the_temp'])."&deg;C";
            $data[$key]['days'] = $value['applicable_date'];
            $data[$key]['max_temp'] = round($value['max_temp'])."&deg;C";
            $data[$key]['min_temp'] = round($value['min_temp'])."&deg;C";
            $data[$key]['weather_name'] = $value['weather_state_name'];
            $data[$key]['weather_icon'] = config('constants.META_WEATHER.IMG_URL').$value['weather_state_abbr'].'.svg';
            $data[$key]['wind'] = round($value['wind_speed']*1.60934, 2).' km/h';
            $data[$key]['direction'] = $value['wind_direction_compass'];
        }
        return $data;
    }
}