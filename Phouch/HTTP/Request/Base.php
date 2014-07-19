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
                $this->setOptions($arg0);
            }
        }
    }

    public function execute(){
        try {
            if(!$this->_options instanceof \Phouch\HTTP\Options)
                throw new \Phouch\Exception\HTTP\Options\NotSet();

        } catch(\Exception $e){
            echo $e->getMessage();
            return; //TODO Make execute return Response Object
                    //with error state, pass the Exception, or
                    //Exception::getMessage result.
        }


    }

    public function setOptions(\Phouch\HTTP\Options $options){
        $this->_options = $options;
    }
}