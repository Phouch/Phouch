<?php

namespace Phouch\Model;

class Document extends Base {
    protected $_database;
    protected $_values;
    
    /**
     * Set database
     * 
     * @param string $database
     * @return \Phouch\Model\Document
     */
    public function setDatabase($database) {
        $this->_database = $database;
        
        return $this;
    }
    
    /**
     * Get database
     * 
     * @return string
     */
    public function getDatabase() {
        return $this->_database;
    }
}