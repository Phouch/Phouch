<?php

namespace Phouch\HTTP\Service;

class Factory {
    public static function getHttpService(\Phouch\Config $config){
        
        $provider_class = $config->getHttpServiceClass();
        
        if(!class_exists($provider_class, false))
            throw new \Exception("Provider class '".$provider_class."' does not exist.");
            
        return new $provider_class;
    }
}