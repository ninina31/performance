<?php

  namespace Mpwar\Component\Routing;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Request\Parameters;

  class Routing
  {

    public function getRoute(Request $request)
    {
      $uri = $request->server->getValue('REQUEST_URI');
      $uri_array = explode('/', $uri);
      array_shift($uri_array); // delete first black space
      $controller = array_shift($uri_array);
      $string = file_get_contents('../src/Config/Routing.json');
      $json_array = json_decode($string, true);
      foreach ($json_array as $key => $value) {
        if ($value['controller'] == $controller) {
          return new Route($value['route'], 'home', $uri_array);
        }
      }
      return new Route("\\Controller\\Exceptions\\Exceptions", 'notFound');
    }
  }
