<?php
/**
 * Phouch\Config
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * @description Master configuration for this Phouch
 * instance. Will contain the following (a living list
 * until version 1.0.0):
 *
 * - Default HTTP Option Object
 *
 */

namespace Phouch;

class Config 
{
    public $username,
        $password,
        $host,
        $port,
        $cert_file_path,
        $transport,
        $http_service_providers = array(),
        $http_service_provider;
    
    /**
     * @param array $array
     */
    public function __construct(array $array = null)
    {    
        if(null !== $array){
            $this->setFromArray($array);
        }
    }
    
    public function getHost()
    {
        return $this->host;
    }
    
    public function getPort()
    {
        return $this->port;
    }
    
    public function getTransport()
    {
        return $this->transport;
    }
    
    public function getCertificateFilePath()
    {
        return $this->cert_file_path;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getHttpServiceClass()
    {
        if(!array_key_exists($this->http_service_provider, $this->http_service_providers))
            throw new \Exception("The key '$this->http_service_provider' does not exist in service providers array.");
        
        return $this->http_service_providers[$this->http_service_provider];
    }
    
    /**
     * Set properties from array Ex. array("http_provider" => Phouch\Config::HTTP_PROVIDER_CURL)
     * @param array $array
     * @return \Phouch\Config
     */
    public function setFromArray(array $array) 
    {
        foreach ($array as $key => $value) {
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
        
        return $this;
    }
}
