<?php
return array(
    "username" => "myusername",
    "password" => "mypassword",
    "host" => "myurl",
    "port" => "myport",
    "cert_file_path" => "path/to/my/cert.file",
    "transport" => "https",
    "http_service_providers" => array(
        "Phouch_Curl" => "Phouch\HTTP\Service\Curl" 
    ),
    "http_service_provider" => "Phouch_Curl"
);
