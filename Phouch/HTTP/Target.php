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

  const TRANSPORT_METHOD_HTTP = 'http';
  const TRANSPORT_METHOD_SECURE = 'https';

  private $transport; //supplied @ config options
  private $host; // supplied @ config options
  private $collection; // supplied @ config options
  private $id; //supplied @ config options
  private $command; //couch commands like _all_dbs
  private $options; //should be options object, can be passed global or individual to the target

  public function __construct(){
    $this->transport = self::TRANSPORT_METHOD_HTTP;
    return $this;
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
