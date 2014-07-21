<?php

namespace Phouch\HTTP\Options;

class PUT extends Base {
    public function __construct(){
        $this->method = 'PUT';
    }
}