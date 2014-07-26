<?php

namespace Phouch;

class Document
{
    protected $_uuid;
    protected $_version;
    protected $_database;
    protected $_values = array();
    
    /**
     * Set unique identifier
     * 
     * @param string $uuid
     * @return \Phouch\Document
     */
    public function setUUID($uuid)
    {
        $this->_uuid = $uuid;
        
        return $this;
    }
    
    /**
     * Get unique identifier
     * 
     * @return string
     */
    public function getUUID()
    {
        return $this->_uuid;
    }
    
    /**
     * Set the document version
     * 
     * @param string $version
     * @return \Phouch\Document
     */
    public function setVersion($version)
    {
        $this->_version = $version;
        
        return $this;
    }
    
    /**
     * Get the document version
     * 
     * @return type
     */
    public function getVersion()
    {
        return $this->_version;
    }


    /**
     * Set database
     * 
     * @param string $database
     * @return \Phouch\Document
     */
    public function setDatabase($database)
    {
        $this->_database = $database;
        
        return $this;
    }
    
    /**
     * Get database
     * 
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }
    
    /**
     * Set a value
     * 
     * @param string $key
     * @param mixed $value
     * @return \Phouch\Document
     */
    public function setValue($key, $value)
    {
        $this->_values[$key] = $value;
        return $this;
    }
    
    /**
     * Get a document value by key
     * 
     * @param string $key
     * @return mixed
     * @throws \Phouch\Exception\Document\Value\Exception
     */
    public function getValue($key)
    {
        if(!isset($this->_values[$key])) {
            throw new \Phouch\Exception\Document\Value\Exception;
        }
        
        return $this->_values[$key];
    }
}