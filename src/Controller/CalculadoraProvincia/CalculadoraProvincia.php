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
      $redis = $container->get('redis');

      if (empty($cp)) {
        return new Response($template->render('CalculadoraProvincia/home.html.twig', []));
      } else {

        if (!is_numeric($cp)) {
          $provincias = array('provincia' => 'El código de la provincia es inválido');
          return new Response($template->render('CalculadoraProvincia/result.html.twig', $provincias));
        }

        $codpostal = substr($cp, 0, 2);

        $item = $database->getMunicipalityFromPC($codpostal);
        $provincias = array('provincia' => 'No se encontró la provincia');

        if (!empty($item)) {
          $provincias = $item;
          $redisConexion = $redis->connect();
          //$r = $request->redis;
          //$r->zAdd('key', 0, $cp);

          $redisConexion->zIncrBy('site_visits', 1, $cp);

          //$r->setnx($cp, '0');
          //$r->incr($cp);
          //$value = $r->get($cp);
          //$value2 = $r->get('key1');


          //$r->zAdd('$item', 2.5, 'val2');
          //$value = $r->zScore($item, 'val');
          //$r->set(foo,bar);
          //$value = $r->get('site_visits');
          //echo $value . "Siii";

        }

        return new Response($template->render('CalculadoraProvincia/result.html.twig', $provincias));
      }
    }

  }
