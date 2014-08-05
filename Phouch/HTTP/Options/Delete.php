<?php

namespace Phouch\HTTP\Options;

class Delete extends OptionsAbstract
{
    public function __construct($options = null)
    {
        $this->_method = 'DELETE';
        parent::__construct($options);
    }
}
