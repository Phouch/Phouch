<?php
/**
 * Phouch\HTTP\Service\Curl
 * @description A concrete implementation of
 * an HttpService object, using Curl.
 */

namespace Phouch\HTTP\Service;

class Curl implements HttpServiceInterface
{
    private $_curlHandle;

    public function __construct()
    {
        $this->setCurlHandle();
    }

    public function setCurlHandle()
    {
        if(!isset($this->_curl_handle))
            $this->_curlHandle = curl_init();
        return $this;
    }

    public function setOptions(\Phouch\HTTP\Options\OptionsAbstract $options)
    {
        $opts = array();

        $opts[CURLOPT_CUSTOMREQUEST] = $options->getMethod();
        $opts[CURLOPT_URL] = $options->getTransport()
            . '://' . $options->getHost()
            . ':' . $options->getPort()
            . $options->getUri();

        if($options instanceof \Phouch\HTTP\Options\Post)
            $opts[CURLOPT_POSTFIELDS] = json_encode($options->getPostData());

        curl_setopt_array($this->_curlHandle, $opts);
    }

    public function execute()
    {
        return json_decode(curl_exec($this->_curlHandle), true);
    }
}
