<?php

function __autoload($class){
  require_once(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
}
