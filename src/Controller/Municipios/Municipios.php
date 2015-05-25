<?php

  namespace Controller\Municipios;
  use Mpwar\Controller\BaseController;
  use Mpwar\Component\Request\Request;
  use Mpwar\Component\Response\Response;
  use Component\Container;
  use Mpwar\Sphinx\SearchSphinx;

  class Municipios extends BaseController
  {
    const MUNICIPIOS_POR_PAGINA = 10;
	
    public function __construct()
    {
      parent::__construct();
    }

    public function home(Request $request, $provincia = '')
    {
	
	  $paginado = $request->route->getVars();
	  if(empty($paginado[1])){
		$paginado[1] = 0;
	  }
	  $container = new Container();
      $template = $container->get('twig');
	  $sphinx = new SearchSphinx();
	  
      if (empty($provincia)) {
        $municipios = array('municipios' => 'No se encontraron municipios');
        return new Response($template->render('Municipios/home.html.twig', $municipios));
      }
	
	  $municipiosStartIn = $paginado[1] * 10;
	  
	  $item = $sphinx->search($provincia, $municipiosStartIn, self::MUNICIPIOS_POR_PAGINA);

      if (!empty($item)) {
        $municipios = $item;
		}
	  else {
		$municipios = array('municipios' => 'No se encontraron municipios');
		}
		$datos = $item[0]['matches'];
	  
	  $nextPage = $paginado[1] + 1;
	  $anteriorPage = $paginado[1] - 1;
	  
	  if ($paginado[1] == 0) {
	  $concat = $provincia . '/' . $nextPage;
	  $vars_template = array('municipios' => $datos, 'pagina' => $concat);
	  }
	  else {
	  $vars_template = array('municipios' => $datos, 'pagina' => $nextPage, 'anterior' => $anteriorPage);
	  }

      return new Response($template->render('Municipios/home.html.twig', $vars_template));
    }
  }
