<?php

namespace Asorasoft\Bill;

use Exception;
use GuzzleHttp\Client;

class BillClient
{
    public $bill;

    public $client;

    public function __construct()
    {
        $this->bill = new Bill(config('bill.api_url'), config('bill.secret_key'));

        $this->client = new Client([
            'verify' => config('bill.verify_ssl'),
            'headers' => [
                'Authentication' => "Basic " . $this->bill->secretKey,
                'Accept' => 'application/json',
                'Content-Type' => 'multipart/form-data'
            ]
        ]);
    }

    public function post($url, $params = [])
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('POST', $uri, [
                'form_params' => $params
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function postWithFile($url, $params = [])
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('POST', $uri, [
                'multipart' => $params
            ]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function get($url)
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('GET', $uri);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
