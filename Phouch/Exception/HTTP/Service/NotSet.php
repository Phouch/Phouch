<?php

namespace Phouch\Exception\HTTP\Service;

class NotSet extends \Phouch\Exception\ExceptionAbstract
{
    public function __construct()
    {
        $message = 'HTTP Service not set.';
        parent::__construct($message);
    }
}