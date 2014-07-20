<?php

namespace Phouch\HTTP\Options;

class Post extends Base {
    public function __construct(){
        $this->method = 'POST';
    }
}