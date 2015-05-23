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

      $vars_template = array('provincias' => $provincias);

      return new Response($template->render('Home/home.html.twig', $vars_template));
    }

    public function addItem(Request $request, $name = '')
    {
      $container = new Container();
      $template = $container->get('twig');

      $database = $container->get('database');
      if ($database->insertItem($name)) {
        $vars_template = array('msg' =>'Ingreso exitoso');
      } else {
        $vars_template = array('msg' =>'Ingreso fallido');
      }


      return new Response($template->render('Home/home.html.twig', $vars_template));
    }

    public function getItem(Request $request, $id = '')
    {
      if (!empty($request->get->getValue('extra'))) {
        $vars_template['extra'] = $request->get->getValue('extra');
      }
      
      $container = new Container();
      $template = $container->get('twig');

      $database = $container->get('database');

      $item = $database->getItem($id);
      $info = 'No se encontro item';

      if (!empty($item)) {
        $info = $item;
      }

      $vars_template = array('msg' => 'Item:', 'info' => $info);
      
      if (!empty($request->get->getValue('extra'))) {
        $vars_template['extra'] = $request->get->getValue('extra');
      }

      return new Response($template->render('Home/home.html.twig', $vars_template));
    }

    public function updateItem(Request $request, $oldName = '', $newName = '')
    {
      $container = new Container();
      $template = $container->get('twig');

      $database = $container->get('database');
      if ($database->updateItem($oldName, $newName)) {
        $vars_template = array('msg' =>'Actualizacion exitosa');
      } else {
        $vars_template = array('msg' =>'Actualizacion fallida');
      }

      return new Response($template->render('Home/home.html.twig', $vars_template));
    }

    public function deleteItem(Request $request, $name = '')
    {
      $container = new Container();
      $template = $container->get('twig');

      $database = $container->get('database');
      if ($database->deleteItem($name)) {
        $vars_template = array('msg' =>'Eliminacion exitosa');
      } else {
        $vars_template = array('msg' =>'Eliminacion fallida');
      }

      return new Response($template->render('Home/home.html.twig', $vars_template));
    }
    public function getSmartyItem(Request $request, $id = '')
    {
      $container = new Container();
      $template = $container->get('smarty');

      $database = $container->get('database');

      $item = $database->getItem($id);
      $info = 'No se encontro item';

      if (!empty($item)) {
        $info = $item;
      }

      $vars_template = array('name' => $info);
      
      if (!empty($request->get->getValue('extra'))) {
        $vars_template['extra'] = $request->get->getValue('extra');
      }

      return new Response($template->render(dirname(__FILE__) . '/../../Views/Home/test.tpl', $vars_template));
    }
  }
