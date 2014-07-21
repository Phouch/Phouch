<?php

namespace Phouch\HTTP\Options;

class DELETE extends Base {
    public function __construct(){
        $this->method = 'DELETE';
    }
}