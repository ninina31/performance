<?php

  namespace Controller\Home;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\JsonResponse;
  use Component\Container;

  class JsonHome extends BaseController
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function getJsonItem(Request $request, $name = '')
    {

      $container = new Container();
      $template = $container->get('twig');

      $database = $container->get('database');

      $json_result = array('item' => $database->getItem($name));

      return new JsonResponse($json_result);
    }
  }
