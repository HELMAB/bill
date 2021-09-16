<?php
return [
    'secret_key' => env("BILL_SECRET_KEY", "bill"),

    'api_url' => env("BILL_API_URL", "http://localhost:8000"),

    'verify_ssl' => env("BILL_VERIFY_SSL", false)
];
