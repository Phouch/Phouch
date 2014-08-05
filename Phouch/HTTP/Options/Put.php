<?php

namespace Phouch\HTTP\Options;

class Put extends OptionsAbstract
{
    private $_payload = array();

    public function __construct($options = null)
    {
        $this->_method = 'PUT';
        parent::__construct($options);
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
