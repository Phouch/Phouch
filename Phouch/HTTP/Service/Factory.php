<?php

namespace Phouch\HTTP\Service;

class Factory {
    public static function getHttpService($provider = 'default'){
        $provider = $provider === 'default'
            ? DEFAULT_HTTP_SERVICE_PROVIDER
            : $provider;

        switch ($provider) {
            case HTTP_SERVICE_CURL:
                $service = new Curl();
            break;
            default:
                $service = self::getHttpService(DEFAULT_HTTP_SERVICE_PROVIDER);
        }

        return $service;
    }
}