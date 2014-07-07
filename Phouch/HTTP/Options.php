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

  /**
   * @param can be an array, or string
   *
   * If array, will look for keys transport, host, and port,
   * and will set accordingly.
   *
   * If string, will check to see if it's long enough
   * to be a legitimate target, then attempt to dissect a
   * perfectly formed URL target, and assign appropriately.
   *
   */
  public function __construct(){
    if(func_num_args() > 0){
      $arg0 = func_get_arg(0);
      if(is_array($arg0)){
        if(array_key_exists('port', $arg0))
          $this->setPort($arg0['port']);
        if(array_key_exists('transport', $arg0))
          $this->setTransport($arg0['transport']);
        if(array_key_exists('host', $arg0))
          $this->setHost($arg0['host']);
      } elseif(filter_var($arg0, FILTER_VALIDATE_URL)) {
        //first set transport
        //then host
        //then port
      }
    }
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