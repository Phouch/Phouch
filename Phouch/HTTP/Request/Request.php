<?php
/**
 * Phouch\HTTP\Request
 *
 * @description Phouch HTTP Request object. Operates by attaching
 * a set of HTTP\Options to it, either by constructor, setter, or
 * Request::execute() method. Options can be for any type of
 * request and be parsed accordingly.
 *
 *  - PUT
 *  - POST
 *  - GET
 *  - DELETE
 *
 * Mechanics use the php-curl library to manage the request.
 */
namespace Phouch\HTTP;

class Request {

	protected $_curl_handle;

	/** @var \Phouch\HTTP\Options */
	protected $_options;

    public function __construct(){
    	$this->setCurlHandle();
        if(func_num_args() > 0)
            $this->setOptionsIfPassed(func_get_arg(0));
    }

    public function execute(){

        if(func_num_args() > 0)
            $this->setOptionsIfPassed(func_get_arg(0));

        try {
            if(!$this->_options instanceof Options)
                throw new \Phouch\Exception\HTTP\Options\NotSet();

            if(!$this->_curl_handle)
                throw new \Phouch\Exception\HTTP\Curl\NotSet();

        } catch(\Exception $e){
            return new Response(
                array('error' => $e->getMessage())
            );
        }

        curl_setopt_array($this->_curl_handle,$this->_options->getCurlOptions());

        return new Response(
            json_decode(curl_exec($this->_curl_handle), true)
        );

    }

    public function setOptions(Options $options){
        $this->_options = $options;
        return $this;
    }

    public function setCurlHandle(){
        if(!isset($this->_curl_handle))
            $this->_curl_handle = curl_init();
        return $this;
    }

    private function setOptionsIfPassed($options){
        if($options instanceof Options){
            $this->setOptions($options);
        }
    }
}