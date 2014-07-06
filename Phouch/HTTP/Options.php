<?php

namespace Phouch\HTTP;

class Options {

  const TRANSPORT_METHOD_HTTP = 'http';
  const TRANSPORT_METHOD_SECURE = 'https';

  private $host;
  private $port;
  private $transport;

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