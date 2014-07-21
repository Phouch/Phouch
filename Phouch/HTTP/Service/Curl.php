<?php
/**
 * Phouch\HTTP\Service\Curl
 * @description A concrete implementation of
 * an HttpService object, using Curl.
 */

namespace Phouch\HTTP\Service;

use Phouch\HTTP\Options\Base as OptionsBase,
    Phouch\HTTP\Options\Post as OptionsPost;

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

    public function setOptions(OptionsBase $options){
        $opts = array();

        $opts[CURLOPT_CUSTOMREQUEST] = $options->getMethod();
        $opts[CURLOPT_URL] = $options->getTransport()
            . '://' . $options->getHost()
            . ($options->getPort() ? ':' . $options->getPort() : "")
            . $options->getUri();

        if($options instanceof OptionsPost)
            $opts[CURLOPT_POSTFIELDS] = json_encode($options->getPostData());

        if($options->getUsername() && $options->getPassword())
            $opts[CURLOPT_USERPWD] = $options->getUsername() .":". $options->getPassword();

        if($options->getCertPath())
            $opts[CURLOPT_CAINFO] = "/wamp/www/cacert.pem";
        
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_HTTPHEADER] = array( 'Content-type: application/json', 'Accept: */*' );

        curl_setopt_array($this->_curl_handle, $opts);
    }

    public function execute(){
        $response = curl_exec($this->_curl_handle);

        if(!$response) {
            $status_code = curl_getinfo($this->_curl_handle, CURLINFO_HTTP_CODE);

            throw new \Exception("Curl error: " . curl_error($this->_curl_handle), $status_code);
        }
        
        return json_decode($response, true);
    }
}
