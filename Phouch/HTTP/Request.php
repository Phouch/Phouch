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
 * The HTTP\Request also requires an HttpService, which can be
 * configured based on the environment or choice of technology.
 */
namespace Phouch\HTTP;

class Request {

    /** @var  \Phouch\HTTP\Service\HttpService */
    protected $_http_service;

	/** @var \Phouch\HTTP\Options\Base */
	protected $_options;

    public function __construct(){
        if(func_num_args() > 0)
            $this->setComponentsIfPassed(func_get_args());
    }

    public function execute(){

        if(func_num_args() > 0)
            $this->setComponentsIfPassed(func_get_args());

        try {
            if(!$this->_options instanceof Options\Base)
                throw new \Phouch\Exception\HTTP\Options\NotSet();

            if(!$this->_http_service instanceof Service\HttpService)
                throw new \Phouch\Exception\HTTP\Service\NotSet();

        } catch(\Exception $e){
            return new Response(
                array('error' => $e->getMessage())
            );
        }

        $this->_http_service->setOptions($this->_options);

        return new Response(
            $this->_http_service->execute()
        );

    }

    public function setOptions(Options\Base $options){
        $this->_options = $options;
        return $this;
    }

    public function setHTTPService(Service\HttpService $http_service){
        $this->_http_service = $http_service;
        return $this;
    }

    private function setComponentsIfPassed($components){
        foreach($components as $component){
            if($component instanceof Options\Base)
                $this->setOptions($component);

            if($component instanceof Service\HttpService)
                $this->setHTTPService($component);

        }
    }
}