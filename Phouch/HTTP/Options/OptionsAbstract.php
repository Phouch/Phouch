<?php
/**
 * Phouch\HTTP\Options\OptionsAbstract
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * @description HTTP options, should encompass:
 * - transport method (http / https)
 * - host (example.com)
 * - port (5894)
 * and be extended to fully implement any type of
 * HTTP request.
 */

namespace Phouch\HTTP\Options;

abstract class OptionsAbstract {

    private $host = '127.0.0.1';
    private $port = 5984;
    private $transport = 'http';
    private $uri = '/';
    protected $method;

    /**
    * @param can be an array, or nothing.
    *
    * If array, will look for keys transport, host, and port,
    * and will set accordingly.
    *
    * If nothing, will assume values as default, or that the
    * user will set options with a setter.
    */
    public function __construct(){
        if(func_num_args() > 0){
            $arg0 = func_get_arg(0);
            if(is_array($arg0))
                $this->setWithArray($arg0);
        }
        return $this;
    }

    public function setWithArray(array $options){
        if(array_key_exists('port', $options))
            $this->setPort($options['port']);
        if(array_key_exists('transport', $options))
            $this->setTransport($options['transport']);
        if(array_key_exists('host', $options))
            $this->setHost($options['host']);
        if(array_key_exists('uri', $options))
            $this->setUri($options['uri']);
        return $this;
    }

    public function setHost($host){
        $this->host = $host;
        return $this;
    }

    public function setURI($uri){
        $this->uri = $uri;
        return $this;
    }

    public function setPort($port){
        try {
            if(!ctype_digit($port)) throw new \Phouch\Exception\HTTP\Port($port);
            $this->port = $port;
        } catch (\Phouch\Exception\HTTP\Port $invalidPortException){
            echo $invalidPortException->getMessage();
        }
        return $this;
    }

    public function setTransport($transport){
        $this->transport = $transport !== 'https'
            ? 'http' : $transport;
        return $this;
    }

    public function getHost(){
        return $this->host;
    }

    public function getPort(){
        return $this->port;
    }

    public function getUri(){
        return $this->uri;
    }

    public function getTransport(){
        return $this->transport;
    }

    public function getMethod(){
        return $this->method;
    }

}