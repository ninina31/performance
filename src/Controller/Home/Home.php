<?php

  namespace Controller\Home;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\Response;
  use Component\Container;

  class Home extends BaseController
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function home(Request $request, $name = '')
    {
      $container = new Container();
      $template = $container->get('twig');
      $database = $container->get('database');

      $item = $database->getProvinces();
      
      $info = 'No se encontro item';

      if (!empty($item)) {
        $provincias = $item;
      }

      $codPostales = array('07087', '89465', '41368', '54623', '74236', '45698', '45698', '09041', '12365', '12345');

      $vars_template = array('provincias' => $provincias, 'codPostales' => $codPostales);

      return new Response($template->render('Home/home.html.twig', $vars_template));
    }

  }
