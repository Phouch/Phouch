<?php

namespace Phouch\HTTP;

class Options {
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

}