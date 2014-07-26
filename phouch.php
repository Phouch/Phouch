<?php

spl_autoload_register(function($class){
    require_once(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

//Application configuration

//HTTP - Default Provider
define('DEFAULT_HTTP_SERVICE_PROVIDER', 'Curl');
//HTTP - Available Providers
define('HTTP_SERVICE_CURL', 'Curl');