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

class Request
{
    /** @var  \Phouch\HTTP\Service\HttpServiceInterface */
    protected $_httpService;

  	/** @var \Phouch\HTTP\Options\OptionsAbstract */
	  protected $_options;

    public function __construct()
    {
        if(func_num_args() > 0)
            $this->setComponentsIfPassed(func_get_args());
    }

    public function execute()
    {
        if(func_num_args() > 0)
            $this->setComponentsIfPassed(func_get_args());

        try {
            if(!$this->_options instanceof Options\OptionsAbstract)
                throw new \Phouch\Exception\HTTP\Options\NotSet();

            if(!$this->_httpService instanceof Service\HttpServiceInterface)
                throw new \Phouch\Exception\HTTP\Service\NotSet();

        } catch(\Exception $e){
            return new Response(
                array('error' => $e->getMessage())
            );
        }

        $this->_httpService->setOptions($this->_options);

        return new Response(
            $this->_httpService->execute()
        );

    }

    public function setOptions(Options\OptionsAbstract $options)
    {
        $this->_options = $options;
        return $this;
    }

    public function setHTTPService(Service\HttpServiceInterface $httpService)
    {
        $this->_httpService = $httpService;
        return $this;
    }

    private function setComponentsIfPassed($components)
    {
        foreach($components as $component){
            if($component instanceof Options\OptionsAbstract)
                $this->setOptions($component);

            if($component instanceof Service\HttpServiceInterface)
                $this->setHTTPService($component);
        }
    }
}
