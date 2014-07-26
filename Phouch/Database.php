<?php

namespace Phouch;

/**
 * @todo Are we going to add docs here or create a different 
 *       object that includes those for persistence?
 */
class Database
{
    protected $_name;
    
    /**
     * Set the database name
     * 
     * @param string $name
     * @return \Phouch\Database
     */
    public function setName($name)
    {
        $this->_name = $name;
        
        return $this;
    }
    
    /**
     * Get the database name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
}