<?php

namespace Phouch\HTTP\Options;

class Get extends Base {
    public function __construct(){
        $this->method = 'GET';
    }
}