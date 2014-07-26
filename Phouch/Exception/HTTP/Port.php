<?php

namespace Phouch\Exception\HTTP;

class Port extends \Phouch\Exception\ExceptionAbstract
{
    public function __construct($port)
    {
        $message = $port . ' is not a valid port number.';
        parent::__construct($message);
    }
}