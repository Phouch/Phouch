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
 * Connection
 *
 *  The Phouch object will hold a singleton instance of a
 *  connection to be utilized in calls.
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

class Phouch {
  public function connect(){}
  public function save(){}
  public function drop(){}
  public function create(){}
}