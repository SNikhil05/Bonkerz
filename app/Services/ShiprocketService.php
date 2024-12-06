<?php

namespace App\Services;

use GuzzleHttp\Client;

class ShiprocketService
{
    protected $client;
    protected $apiUrl = 'https://apiv2.shiprocket.in/v1/external';
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = $this->authenticate();
    }

    private function authenticate()
    {
        $response = $this->client->post($this->apiUrl . '/auth/login', [
            'json' => [
                'email' => 'hari.om@bonwic.com',
            'password' => 'Hariom@12345'
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['token'];
    }

    public function checkPincodeAvailability($pincode)
    {
        $response = $this->client->get($this->apiUrl . '/courier/serviceability/', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ],
            'query' => [
                'pickup_postcode' => '110016',
                'delivery_postcode' => $pincode,
                'cod' => '0', // Use '1' for COD serviceability
                'weight' => 2,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
