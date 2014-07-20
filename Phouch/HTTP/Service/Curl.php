<?php
/**
 * Phouch\HTTP\Service\Curl
 * @description A concrete implementation of
 * an HttpService object, using Curl.
 */

namespace Phouch\HTTP\Service;

class Curl implements HttpService {
    private $_curl_handle;

    public function __construct(){
        $this->setCurlHandle();
    }

    public function setCurlHandle(){
        if(!isset($this->_curl_handle))
            $this->_curl_handle = curl_init();
        return $this;
    }

    public function setOptions(\Phouch\HTTP\Options\Base $options){
        $opts = array();
        $opts[CURLOPT_CUSTOMREQUEST] = $options->getMethod();
        $opts[CURLOPT_URL] = $options->getTransport()
            . '://' . $options->getHost()
            . ':' . $options->getPort()
            . $options->getUri();
        curl_setopt_array($this->_curl_handle, $opts);
    }

    public function execute(){
        return json_decode(curl_exec($this->_curl_handle), true);
    }
}
