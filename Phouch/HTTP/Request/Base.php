<?php
/**
 * Phouch\HTTP\Request\Base
 *
 * @description Base HTTP Request object. Should be extended
 * and made concrete by a specific implementation of an HTTP
 * request.
 *
 *  - PUT
 *  - POST
 *  - GET
 *  - DELETE
 *
 * Mechanics use the php-curl library to manage the request.
 */
namespace Phouch\HTTP\Request;

abstract class Base {

	protected $_curl_handle;

	/** @var \Phouch\HTTP\Options */
	protected $_options;

    public function __construct(){
    	if(!isset($this->_curl_handle))
    		$this->_curl_handle = curl_init();

        if(func_num_args() > 0)
            $this->setOptionsIfPassed(func_get_arg(0));
    }

    public function execute(){

        if(func_num_args() > 0)
            $this->setOptionsIfPassed(func_get_arg(0));

        try {
            if(!$this->_options instanceof \Phouch\HTTP\Options)
                throw new \Phouch\Exception\HTTP\Options\NotSet();

            if(!$this->_curl_handle)
                throw new \Phouch\Exception\HTTP\Curl\NotSet();

        } catch(\Exception $e){
            echo $e->getMessage();
            return; //TODO Make execute return Response Object
                    //with error state, pass the Exception, or
                    //Exception::getMessage result.
        }

        curl_setopt_array($this->_curl_handle,$this->_options->getCurlOptions());

        return new \Phouch\HTTP\Response(
            json_decode(curl_exec($this->_curl_handle), true)
        );

    }

    public function setOptions(\Phouch\HTTP\Options $options){
        $this->_options = $options;
    }

    private function setOptionsIfPassed($options){
        if($options instanceof \Phouch\HTTP\Options){
            $this->setOptions($options);
        }
    }
}