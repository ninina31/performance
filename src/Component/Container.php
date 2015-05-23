<?php

namespace Component;
use ReflectionClass;

class Container
{

  public function get($service)
  {
    include '../src/Config/Services.php';
    $arguments = array();

    if (!empty($container[$service])) {
      if (!empty($container[$service]['args'])) {
        foreach ($container[$service]['args'] as $arg) {
          array_push($arguments, new $arg());
        }
      }
    }

    $reflection = new ReflectionClass($container[$service]['class']);
    return $reflection->newInstanceArgs($arguments);
  }
}
