<?php

  namespace Mpwar\Component;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Routing\Routing;
  use Mpwar\Component\Routing\Route;

  class Bootstrap
  {

    public function execute()
    {
      $request = new Request();
      $routing = new Routing();
      $route = $routing->getRoute($request);
      return $this->executeController($route, $request);
    }

    public function executeController(Route $route, Request $request)
    {
      $controller = $route->getController();
      $action = $route->getAction();
      $vars = $this->getVarsForController($request, $route->getVars());
      return call_user_func_array(
        array(
          new $controller(), 
          $route->getAction()
        ), 
        $vars
      );
    }

    private function getVarsForController($request, $vars)
    {
      $routeVars = array($request);

      return array_merge($routeVars, $vars);
    }
  }
