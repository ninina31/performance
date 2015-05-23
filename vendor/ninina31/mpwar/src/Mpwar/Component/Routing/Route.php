<?php

namespace Mpwar\Component\Routing;

class Route
{
  
  private $controller;
  private $action;
  private $vars;

  function __construct($controller, $action, $vars = array())
  {
    $this->controller = $controller;
    $this->action = $action;
    $this->vars = $vars;
  }

  public function getController()
  {
    return $this->controller;
  }

  public function getAction()
  {
    return $this->action;
  }

  public function getVars()
  {
    return $this->vars;
  }
}
