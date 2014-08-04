<?php

namespace Phouch\HTTP\Options;

class Put extends OptionsAbstract
{
    private $_payload = array();

    public function __construct()
    {
        $this->_method = 'PUT';

        if(func_num_args() > 0){
            $arg0 = func_get_arg(0);
            if(is_array($arg0))
                $this->setWithArray($arg0);
        }
    }

    public function setPayload(array $data)
    {
        $this->_payload = $data;
        return $this;
    }

    public function getPayload()
    {
        return $this->_payload;
    }
}
