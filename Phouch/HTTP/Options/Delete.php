<?php

namespace Phouch\HTTP\Options;

class Delete extends OptionsAbstract
{
    public function __construct()
    {
        $this->_method = 'DELETE';

        if(func_num_args() > 0){
            $arg0 = func_get_arg(0);
            if(is_array($arg0))
                $this->setWithArray($arg0);
        }
    }
}
