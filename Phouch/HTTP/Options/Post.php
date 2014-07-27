<?php

namespace Phouch\HTTP\Options;

class Post extends OptionsAbstract
{
    private $_payload = array();

    public function __construct()
    {
        $this->_method = 'POST';
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
