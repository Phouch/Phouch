<?php

namespace Phouch\HTTP\Options;

class Put extends Base {
    public function __construct(){
        $this->method = 'PUT';
    }
}