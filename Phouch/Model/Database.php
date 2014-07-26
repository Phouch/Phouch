<?php
/**
 * Phouch\Model\Database
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * 
 * Database model, will be responsible for commands
 * such as _all_dbs, etc, along with typical database
 * duties - finding, saving documents.
 */

namespace Phouch\Model;

class Database extends ModelAbstract
{
    protected $_name;
    
    public function setName($name)
    {
        $this->_name = $name;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
}
