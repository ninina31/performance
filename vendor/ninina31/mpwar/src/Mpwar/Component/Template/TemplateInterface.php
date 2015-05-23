<?php

namespace Mpwar\Component\Template;

interface TemplateInterface
{
  
  public function __construct();

  public function render($template, $parameters = array());

}
