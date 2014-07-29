<?php
/**
 * Phouch\HTTP\Response
 * @description Response object from HTTP requests, a
 * product of the HTTP\Request execution.
 */

namespace Phouch\HTTP;

class Response
{
    const ERROR_NOT_FOUND   = "not_found";
    const REASON_DELETED    = "deleted";

    /**
     * @description Takes either an array with key 'error'
     * and value of the Exception's message, or the array
     * provided from CouchDB after execution of an
     * HTTP\Request. If Couch errors, the 'error' key will
     * be natively present from CouchDB.
     * @param array $response
     */
    public function __construct(array $response)
    {
        foreach($response as $k => $v){
            $this->$k = $v;
        }
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return isset($this->error) ? true : false;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->hasError() ? $this->error : "";
    }

}
