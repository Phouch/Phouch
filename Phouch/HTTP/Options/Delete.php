<?php

namespace Phouch\HTTP\Options;

class Delete extends OptionsAbstract
{
    public function __construct()
    {
        $this->method = 'DELETE';
    }
}