<?php

namespace Asorasoft\Bill;

class Bill
{
    public $secretKey;

    public $apiUrl;

    public function __construct($apiUrl, $secretKey)
    {
        $this->apiUrl = $apiUrl;
        $this->secretKey = $secretKey;
    }
}
