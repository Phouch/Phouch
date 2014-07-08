<?php
/**
 * Phouch\HTTP\Target
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * @description The object that holds all data related to an
 * HTTP target during a request.
 *
 * @example How this object will be used, (assume a namespace
 * of Phouch\HTTP), - subject to evolution prior to v1.0.0.
 *
 * Via constructor method:
 *
 * new Request\Get(new Target('collection/id', $config));
 *
 * Via chaining setters:
 *
 * new Request\Get(
 *   new Target()
 *     ->setOptions($config)
 *     ->addCollection('collection')
 *     ->addId('id')
 * );
 */

namespace Phouch\HTTP;

class Target {

  private $port;
  private $transport; //supplied @ config options
  private $host; // supplied @ config options
  private $collection; // supplied @ config options
  private $id; //supplied @ config options
  private $command; //couch commands like _all_dbs

  public function __construct(){
    if(func_num_args() > 0){
      $arg0 = func_get_arg(0);
      if($arg0 instanceof Options)
        $this->setOptions($arg0);
    }
    return $this;
  }

  public function setOptions(Options $options){
    $this->transport = $options->getTransport();
    $this->host = $options->getHost();
    $this->port = $options->getPort();
  }

  public function __toString(){
    $string = $this->transport . "://" . $this->host;
    return $string;
  }

  public function addCollection($collection){
    $this->collection = $collection;
    return $this;
  }

  public function addId($id){
    $this->id = $id;
    return $this;
  }

}
