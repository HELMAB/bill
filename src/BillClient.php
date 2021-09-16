<?php

namespace Asorasoft\Bill;

use ApiConnectionException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BillClient
{
    public $bill;

    public $client;

    public function __construct()
    {
        $this->bill = new Bill(config('bill.api_url'), config('bill.secret_key'));

        $this->client = new Client([
            'verify' => false,
            'headers' => [
                'Authentication' => "Basic " . $this->bill->secretKey,
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws ApiConnectionException
     */
    public function post($url, $params = [])
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('POST', $uri, [
                'form_params' => $params
            ]);
        } catch (Exception $exception) {
            throw new ApiConnectionException($exception->getMessage());
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiConnectionException
     */
    public function postWithFile($url, $params = [])
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('POST', $uri, [
                'multipart' => $params
            ]);
        } catch (Exception $exception) {
            throw new ApiConnectionException($exception->getMessage());
        }
    }

    /**
     * @throws GuzzleException
     * @throws ApiConnectionException
     */
    public function get($url)
    {
        $uri = $this->bill->apiUrl . $url;
        try {
            return $this->client->request('GET', $uri);
        } catch (Exception $exception) {
            throw new ApiConnectionException($exception->getMessage());
        }
    }
}
