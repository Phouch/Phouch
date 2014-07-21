<?php

namespace Phouch\HTTP\Options;

class GET extends Base {
    public function __construct(){
        $this->method = 'GET';
    }
}
