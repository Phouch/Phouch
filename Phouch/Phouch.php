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

use Phouch\HTTP\Response,
    Phouch\Http\Options\OptionsAbstract,
    Phouch\HTTP\Options\Get,
    Phouch\HTTP\Options\Put,
    Phouch\HTTP\Options\Delete,
    Phouch\HTTP\Service\Factory as ServiceFactory;

class Phouch
{
    
    const URI_ALL_DBS = "/_all_dbs";
    const URI_ALL_DOCS = "_all_docs";
    
    /**
     * Phouch configuration object
     * 
     * @var Config
     */
    protected $config;
    
    public function __construct(array $config_array = null)
    {
        $base_array = include '../config/Phouch.php';
        
        $this->config = new Config($base_array);
        
        if(null !== $config_array){
            $this->config->setFromArray($config_array);
        }
    }

    /**
     * GET _all_dbs
     * 
     * @link http://wiki.apache.org/couchdb/HTTP_database_API#Working_with_Databases documentation
     * @return Response
     */
    public function getAllDatabases()
    {
        $options = new Get();
        
        $options->setFromPhouchConfig($this->config)->setURI(self::URI_ALL_DBS);

        return $this->execute($options);
    }

    /**
     * @param string|array|Document $database
     * @return Response
     */
    public function addDatabase($database)
    {
        $database = $this->_createDatabaseFromMixed($database);
        //todo: validate database

        $options = new Put();

        $options->setFromPhouchConfig($this->config)->setURI("/".$database->getName());

        return $this->execute($options);
    }

    /**
     * @param string|array|Document $database
     * @return Response
     */
    public function deleteDatabase($database)
    {
        $database = $this->_createDatabaseFromMixed($database);
        //todo: validate database

        $options = new Delete();

        $options->setFromPhouchConfig($this->config)->setURI("/".$database->getName());

        return $this->execute($options);
    }

    /**
     * @param string|array|Document $database
     * @return Response
     */
    public function getAllDocuments($database)
    {
        $database = $this->_createDatabaseFromMixed($database);
        //todo: validate database

        $options = new Get();

        $options->setFromPhouchConfig($this->config)->setURI("/".$database->getName()."/".self::URI_ALL_DOCS);

        return $this->execute($options);
    }

    /**
     * @param array|Document $document
     * @return Response
     */
    public function getDocument($document)
    {
        $document = $this->_createDocumentFromMixed($document);

        $options = new Get();

        $uri = "/".$document->getDatabase()."/".$document->getUUID();

        if($document->getVersion())
            $uri .= "?rev=".$document->getVersion();

        $options->setFromPhouchConfig($this->config)->setURI($uri);

        return $this->execute($options);
    }

    /**
     * @param array|Document $document
     * @return Response
     */
    public function addDocument($document)
    {
        $document = $this->_createDocumentFromMixed($document);
        //todo: validate document

        $options = new Put();

        $options->setPayload($document->getValues());

        $options->setFromPhouchConfig($this->config)->setURI("/".$document->getDatabase()."/".$document->getUUID());

        return $this->execute($options);
    }

    /**
     * @param array|Document $document
     * @return Response
     */
    public function deleteDocument($document)
    {
        $document = $this->_createDocumentFromMixed($document);
        //todo: validate document

        $options = new Delete();

        $response = $this->getDocument($document);

        if($response->hasError())
        {
            return $response;
        }

        $rev = $document->getVersion() ? $document->getVersion() : $response->_rev;

        $options->setFromPhouchConfig($this->config)->setURI("/".$document->getDatabase()."/".$document->getUUID()."?rev=".$rev);

        return $this->execute($options);
    }

    /**
     * @param OptionsAbstract $options
     * @return Response
     */
    protected function execute(Http\Options\OptionsAbstract $options)
    {
        $http_service = ServiceFactory::getHttpService($this->config);

        $http_service->setOptions($options);

        $request = new HTTP\Request($options, $http_service);

        $response = $request->execute();

        return $response;
    }

    /**
     * @param string|array|Document $database
     * @return Database
     * @throws \InvalidArgumentException
     * @todo Make a Database factory?
     */
    protected function _createDatabaseFromMixed($database)
    {
        if($database instanceof Database)
            return $database;

        if(is_array($database))
            return new Database($database);

        if(is_string($database))
            return new Database(array("name" => $database));

        throw new \InvalidArgumentException("Could not create database");
    }

    /**
     * @param array|Document $document
     * @return Document
     * @throws \InvalidArgumentException
     * @todo Make a Document factory?
     */
    protected function _createDocumentFromMixed($document)
    {
        if($document instanceof Document)
            return $document;

        if(is_array($document))
            return new Document($document);

        throw new \InvalidArgumentException("Could not create document");
    }
    
}
