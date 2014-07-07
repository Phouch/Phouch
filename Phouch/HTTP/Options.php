<?php
/**
 * Phouch\HTTP\Options
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * @description HTTP options, should encompass:
 * - transport method (http / https)
 * - host (example.com)
 * - port (5894)
 */

namespace Phouch\HTTP;

class Options {

  const TRANSPORT_METHOD_HTTP = 'http';
  const TRANSPORT_METHOD_SECURE = 'https';

  private $host = '127.0.0.1';
  private $port = 5984;
  private $transport = 'http';

  public function __construct(){
    return $this;
  }

  public function setHost($host){
    $this->host = $host;
    return $this;
  }

  public function setPort($port){
    try {
      if(!ctype_digit($port)) throw new \Phouch\Exception\HTTP\Port($port);
      $this->port = $port;
    } catch (\Phouch\Exception\HTTP\Port $invalidPortException){
      echo $invalidPortException->getMessage();
    }
    return $this;
  }

  public function setTransport($transport){
    if(strtolower($transport) !== self::TRANSPORT_METHOD_SECURE){
      $transport = self::TRANSPORT_METHOD_HTTP;
    }
    $this->transport = $transport;
    return $this;
  }

  public function getHost(){
    return $this->host;
  }

  public function getPort(){
    return $this->port;
  }

  public function getTransport(){
    return $this->transport;
  }
}