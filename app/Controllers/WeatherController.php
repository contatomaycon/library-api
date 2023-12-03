<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getCurrentWeather()
    {
        try {
            $city = $this->request->getVar('city');
            $cacheKey = $this->generateCacheKey($city);

            $cachedResponse = $this->getWeatherFromCache($cacheKey);
            if ($cachedResponse) {
                return $this->response->setJSON($cachedResponse);
            }

            $weatherData = $this->fetchWeatherData($city);
            $this->saveWeatherToCache($cacheKey, $weatherData);

            return $this->response->setJSON($weatherData);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'message' => 'An error occurred while retrieving weather data'
            ]);
        }
    }

    private function generateCacheKey($city)
    {
        return 'weatherData_' . md5($city);
    }

    private function getWeatherFromCache($cacheKey)
    {
        $cache = \Config\Services::cache();
        return $cache->get($cacheKey);
    }

    private function fetchWeatherData($city)
    {
        $urlHgBrasil = getenv('URL_HGBRASIL_WEATHER');
        $apiKey = getenv('API_KEY_HGBRASIL');
        $client = new Client();

        $response = $client->request('GET', $urlHgBrasil, [
            'query' => [
                'key' => $apiKey,
                'city_name' => $city,
                'fields' => 'only_results,temp,city,condition_code,description,time',
            ],
            'timeout' => 10
        ]);

        return json_decode($response->getBody(), true);
    }

    private function saveWeatherToCache($cacheKey, $weatherData)
    {
        $cache = \Config\Services::cache();
        $cache->save($cacheKey, $weatherData, 900);
    }
}