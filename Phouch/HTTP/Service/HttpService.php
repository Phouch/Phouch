<?php
/**
 * Phouch\HTTP\Service\HttpService interface
 * @description Service Interface for HTTP layer.
 *
 * The purpose of this interface is to provide a
 * contract by which we can implement HTTP service
 * providers, so they may be easily interchanged
 * at any time, so long as there is an implementation
 * for this provider in HttpService form.
 *
 * We do this so the application layer can remain
 * divorced from any one set of technology, i.e.
 * php-curl.
 */

namespace Phouch\HTTP\Service;

interface HttpService {

    /**
     * @param \Phouch\HTTP\Options\Base $options
     * @description Take a Phouch\HTTP\Options object
     * and map it to the service layer's corresponding
     * values.
     * @return mixed
     */
    public function setOptions(\Phouch\HTTP\Options\Base $options);

    /**
     * @description Execute the HTTP Request and
     * return an array to be parsed into a
     * Phouch\HTTP\Response object.
     * @return array
     */
    public function execute();
}