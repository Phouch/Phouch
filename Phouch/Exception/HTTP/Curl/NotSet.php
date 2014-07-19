<?php

namespace Phouch\Exception\HTTP\Curl;

class NotSet extends \Phouch\Exception\Base {
    public function __construct(){
        $message = 'Curl Handle not set.';
        parent::__construct($message);
    }
}