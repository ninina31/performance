<?php

  namespace Controller\Exceptions;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\Response;
  use Component\Container;

  class Exceptions extends BaseController
  {
    
    public function notFound(Request $request)
    {
      $container = new Container();
      $template = $container->get('twig');

      return new Response($template->render('Exceptions/notFound.html.twig'), 404);
    }
  }
