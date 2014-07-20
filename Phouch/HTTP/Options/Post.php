<?php

namespace Phouch\HTTP\Options;

class Post extends Base {

    private $postData = array();

    public function __construct(){
        $this->method = 'POST';
    }

    public function setPostData(array $data){
        $this->postData = $data;
        return $this;
    }

    public function getPostData(){
        return $this->postData;
    }
}