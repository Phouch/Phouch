<?php

namespace Phouch\HTTP\Options;

class Delete extends Base {
    public function __construct(){
        $this->method = 'DELETE';
    }
}