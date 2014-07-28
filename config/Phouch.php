<?php
return array(
    "username" => null, // null or "myusername"
    "password" => null, // null or "mypassword"
    "host" => '127.0.0.1', // host url without transport etc.
    "port" => 5984, // null or port number
    "cert_path" => null, // null or "path/to/my/cert.file"
    "transport" => "https", // https or http
    "http_service_providers" => array(
        "Phouch_Curl" => "Phouch\\HTTP\\Service\\Curl"
        // add any outside providers full namespace here with unique name as index
    ),
    "http_service_provider" => "Phouch_Curl" // set which provider to use by putting the provider's index name
);
