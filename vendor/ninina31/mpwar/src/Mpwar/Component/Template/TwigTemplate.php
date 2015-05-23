<?php

namespace Mpwar\Component\Template;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigTemplate implements TemplateInterface
{
  protected $engine;
  
  public function __construct()
  {
    $loader = new Twig_Loader_Filesystem('../src/Views');
    $this->engine = new Twig_Environment($loader, array('cache' => false));
  }

  public function render($template, $parameters = array())
  {
    return $this->engine->render($template, $parameters);
  }
}
