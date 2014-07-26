<?php

namespace Phouch\HTTP\Options;

class Post extends OptionsAbstract
{
    private $_postData = array();

    public function __construct()
    {
        $this->_method = 'POST';
    }

    public function setPostData(array $data)
    {
        $this->_postData = $data;
        return $this;
    }

    public function getPostData()
    {
        return $this->_postData;
    }
}