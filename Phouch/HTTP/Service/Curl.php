<?php
/**
 * Phouch\HTTP\Service\Curl
 * @description A concrete implementation of
 * an HttpService object, using Curl.
 */

namespace Phouch\HTTP\Service;

use Phouch\HTTP\Options\OptionsAbstract as OptionsAbstract,
    Phouch\HTTP\Options\Post as OptionsPost,
    Phouch\HTTP\Options\Put as OptionsPut;

class Curl implements HttpServiceInterface
{
    private $_curlHandle;

    public function __construct()
    {
        $this->setCurlHandle();
    }

    public function setCurlHandle()
    {
        if(!isset($this->_curlHandle))
            $this->_curlHandle = curl_init();
        return $this;
    }

    public function setOptions(OptionsAbstract $options)
    {
        $opts = array();

        $opts[CURLOPT_CUSTOMREQUEST] = $options->getMethod();
        $opts[CURLOPT_URL] = $options->getTransport()
            . '://' . $options->getHost()
            . ($options->getPort() ? ':' . $options->getPort() : "")
            . $options->getUri();

        if($options instanceof OptionsPost || $options instanceof OptionsPut){
            $opts[CURLOPT_POSTFIELDS] = json_encode($options->getPayload());
            $opts[CURLOPT_HTTPHEADER] = array(
                'Content-type: multipart/form-data; boundary=--phouch-bound-xxx',
                'Accept: */*',
                'Referer: ' . $opts[CURLOPT_URL],
                'Content-Disposition: form-data;'
            );
        } else {
            $opts[CURLOPT_HTTPHEADER] = array( 'Content-type: application/json', 'Accept: */*' );
        }


        if($options->getUsername() && $options->getPassword())
            $opts[CURLOPT_USERPWD] = $options->getUsername() .":". $options->getPassword();

        if($options->getCertPath())
            $opts[CURLOPT_CAINFO] = $options->getCertPath();
        
        $opts[CURLOPT_RETURNTRANSFER] = true;

        curl_setopt_array($this->_curlHandle, $opts);
    }

    public function execute()
    {
        $response = curl_exec($this->_curlHandle);

        if(!$response) {
            $status_code = curl_getinfo($this->_curlHandle, CURLINFO_HTTP_CODE);
            throw new \Exception("Curl error: " . curl_error($this->_curlHandle), $status_code);
        }
        
        return json_decode($response, true);
    }
}
