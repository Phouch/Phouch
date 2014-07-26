<?php
/**
 * Phouch\HTTP\Response
 * @description Response object from HTTP requests, a
 * product of the HTTP\Request execution.
 */

namespace Phouch\HTTP;

class Response
{

    public $response;

    /**
     * @description Takes either an array with key 'error'
     * and value of the Exception's message, or the array
     * provided from CouchDB after execution of an
     * HTTP\Request.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }
}
