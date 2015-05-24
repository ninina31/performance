<?php

  namespace Controller\Municipios;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\Response;
  use Mpwar\Component\Response\JsonResponse;
  use Component\Container;

  class Municipios extends BaseController
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function home(Request $request, $provincia = '')
    {

      $container = new Container();
      $template = $container->get('twig');
      $database = $container->get('database');
      
      
      if (empty($provincia)) {
        $municipios = array('municipios' => 'No se encontraron municipios');
        return new Response($template->render('Municipios/home.html.twig', $municipios));
      }

      $item = $database->getMunicipalityByProvince($provincia);
      $municipios = array('municipios' => 'No se encontraron municipios');

      if (!empty($item)) {
        $municipios = $item;
      }

      $vars_template = array('municipios' => $municipios);

      return new Response($template->render('Municipios/home.html.twig', $vars_template));
    }

    public function allMunicipios(Request $request, $provincia = '')
    {

      $container = new Container();
      $template = $container->get('twig');
      $database = $container->get('database');

      $item = $database->getMunicipalities();
      $municipios = array();

      if (!empty($item)) {
        $municipios = $item;
      }

      return new JsonResponse($municipios);
    }
  }
