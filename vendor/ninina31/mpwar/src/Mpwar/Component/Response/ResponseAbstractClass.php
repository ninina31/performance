<?php

namespace Mpwar\Component\Response;

abstract class ResponseAbstractClass
{

  protected $content;
  protected $status;
  
  public function __construct($content, $status = 200)
  {
    $this->content = $content;
    $this->status = $status;
  }

  abstract protected function send();

}
