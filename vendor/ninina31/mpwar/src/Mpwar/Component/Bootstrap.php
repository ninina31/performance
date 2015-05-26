<?php

  namespace Mpwar\Component;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Routing\Routing;
  use Mpwar\Component\Routing\Route;
  use Mpwar\Component\Cache\MemoryCache;

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
      $request->route = $route;
      $cache = new MemoryCache();
      $controller = $route->getController();
      $action = $route->getAction();
      $vars = $this->getVarsForController($request, $route->getVars());

      $parameters = array_merge(array($controller, $action), $route->getVars());
      $keyName = $cache->getKeyName($parameters);
      $cachedPage = $cache->get($keyName);

      if (!empty($cachedPage)) {
        return $cachedPage;
      }
      
      $result = call_user_func_array(
        array(
          new $controller(),
          $route->getAction()
        ), 
        $vars
      );

      $cache->set($keyName, $result, 60);

      return $result;
    }

    private function getVarsForController($request, $vars)
    {
      $routeVars = array($request);

      return array_merge($routeVars, $vars);
    }
  }
