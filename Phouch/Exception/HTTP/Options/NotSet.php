<?php

namespace Phouch\Exception\HTTP\Options;

class NotSet extends \Phouch\Exception\Base {
    public function __construct(){
        $message = 'HTTP Options not set.';
        parent::__construct($message);
    }
}