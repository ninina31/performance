<?php

namespace Mpwar\Component\Request;

class Parameters
{

  private $parameters;
  
  function __construct($parameters)
  {
    $this->parameters = $parameters;
  }

  public function getValue($key)
  {
    if (!empty($this->parameters[$key])) {
      return $this->parameters[$key];
    }

    return false;
  }
}
?>
