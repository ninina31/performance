<?php

  namespace Controller\CalculadoraProvincia;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\Response;
  use Component\Container;

  class CalculadoraProvincia extends BaseController
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function home(Request $request, $cp = '')
    {
      $container = new Container();
      $template = $container->get('twig');
      $database = $container->get('database');

      if (empty($cp)) {
        return new Response($template->render('CalculadoraProvincia/home.html.twig', []));
      } else {

        $codpostal = substr($cp, 0, 2);

        $item = $database->getMunicipalityFromPC($codpostal);
        $provincias = array('provincia' => 'No se encontró la provincia');

        if (!empty($item)) {
          $provincias = $item;
        }

        return new Response($template->render('CalculadoraProvincia/result.html.twig', $provincias));
      }
    }

  }
