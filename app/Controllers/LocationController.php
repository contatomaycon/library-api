<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use GuzzleHttp\Client;

class LocationController extends ResourceController
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = getenv('API_URL_IBGE');
    }

    public function listStates()
    {
        $cacheKey = 'listStates';
        $cachedResponse = $this->getFromCache($cacheKey);

        if ($cachedResponse) {
            return $this->respond($cachedResponse);
        }

        $states = $this->fetchFromApi('/api/v1/localidades/estados');
        $formattedStates = $this->formatStates($states);

        $this->saveToCache($cacheKey, $formattedStates, 86400);

        return $this->respond($formattedStates);
    }

    public function listCities($stateId)
    {
        $cacheKey = 'listCities' . $stateId;
        $cachedResponse = $this->getFromCache($cacheKey);

        if ($cachedResponse) {
            return $this->respond($cachedResponse);
        }

        $cities = $this->fetchFromApi("/api/v1/localidades/estados/{$stateId}/municipios");
        $formattedCities = $this->formatCities($cities);

        $this->saveToCache($cacheKey, $formattedCities, 86400);

        return $this->respond($formattedCities);
    }

    private function getFromCache($cacheKey)
    {
        $cache = \Config\Services::cache();
        return $cache->get($cacheKey);
    }

    private function saveToCache($cacheKey, $data, $ttl)
    {
        $cache = \Config\Services::cache();
        $cache->save($cacheKey, $data, $ttl);
    }

    private function fetchFromApi($endpoint)
    {
        $client = new Client(['base_uri' => $this->apiUrl]);
        $response = $client->get($endpoint);
        return json_decode($response->getBody()->getContents());
    }

    private function formatStates($states)
    {
        $formattedStates = array_map(function ($state) {
            return [
                'title' => $state->nome,
                'value' => $state->id
            ];
        }, $states);

        usort($formattedStates, function ($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        return $formattedStates;
    }

    private function formatCities($cities)
    {
        $formattedCities = array_map(function ($city) {
            $value = "{$city->nome}, {$city->microrregiao->mesorregiao->UF->sigla}";
            return [
                'title' => $city->nome,
                'value' => $value
            ];
        }, $cities);

        usort($formattedCities, function ($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        return $formattedCities;
    }
}