<?php

namespace Phouch\HTTP\Request;

class Base {

	protected $_curl_handle;

	/** @var \Phouch\HTTP\Options */
	protected $_options;

    public function __construct(\Phouch\HTTP\Options $options){
    	if(!isset($this->_curl_handle))
    		$this->_curl_handle = curl_init();
    }
}