<?php
/**
 * Phouch\Phouch
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * The Phouch object is sort of like the "Entity Manager" in
 * Doctrine 2. It is responsible for pushing Phouch\Model's to
 * persistence.
 *
 * Note: Top level classes in Phouch\Phouch are instantiator
 * classes for more complex objects, ie - facades that safely
 * create a class based on how you will use it.
 *
 * Authorization
 * 
 *  Authorization will be made available to the Phouch 
 *  Object from within a Phouch\HTTP\Options Object taken
 *  from a Phouch\HTTP\Request object during any of the
 *  actionable methods.
 *
 */

namespace Phouch;

class Phouch
{
    
    /**
     * GET _all_dbs
     * 
     * @link http://wiki.apache.org/couchdb/HTTP_database_API#Working_with_Databases documentation
     * @return type Description
     */
    public function getAllDatabases()
    {
        
    }
    
    public function addDatabase($database)
    {
        
    }
    
    public function deleteDatabase($database)
    {
        
    }
    
    public function getAllDocuments($database)
    {
        
    }
    
    public function addDocument($document)
    {
        
    }
    
    public function deleteDocument($document)
    {
        
    }
}
