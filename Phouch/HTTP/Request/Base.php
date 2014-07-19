<?php

namespace Phouch\HTTP\Request;

class Base {

	protected $_curl_handle;

	/** @var \Phouch\HTTP\Options */
	protected $_options;

    public function __construct(){
    	if(!isset($this->_curl_handle))
    		$this->_curl_handle = curl_init();
        if(func_num_args() > 0){
            $arg0 = func_get_arg(0);
            if($arg0 instanceof \Phouch\HTTP\Options){
                $this->_options = $arg0;
            }
        }
    }
}