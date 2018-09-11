<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Storage;

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
            self::saveJson($city, 'not found');
            return null;
        }
        self::saveJson($city, 'found');
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
            $data[$key]['direction'] = config('constants.COMPASS.'.$value['wind_direction_compass']);
        }
        return $data;
    }

    /**
     * function saveJson()
     * to save search city name into json file
     * 
     * @param string $city, city name
     * @param boolean $status, status is true or false (found or not found),
     *  so we can get not found city list and total hit from city found
     */
    private static function saveJson($city, $status){
        try{
            // read json file
            if(!Storage::disk('public')->exists('city.json')){
                $append[$city] = [
                    'status' => $status,
                    'total_hits' => 1
                ];
                Storage::disk('public')->put('city.json', json_encode($append));
            }else{
                $jsonData = Storage::disk('public')->get('city.json');
                $array_city = json_decode($jsonData, TRUE);
                // delete file first
                Storage::disk('public')->delete('city.json');
                if(array_key_exists($city, $array_city)){
                    $append[$city] = [
                        'status' => $array_city[$city]['status'],
                        'total_hits' => $array_city[$city]['total_hits']+1
                    ];
                    
                    unset($array_city[$city]);
                    $array_city +=$append;
                }else{
                    $append[$city] = [
                        'status' => $status,
                        'total_hits' => 1
                    ];
                    $array_city +=$append;
                }
                // the file will be saved into storage/app/public directory
                Storage::disk('public')->put('city.json', json_encode($array_city));
            }
        }catch(\Exception $e){
            dd($e);
        }
    }
}