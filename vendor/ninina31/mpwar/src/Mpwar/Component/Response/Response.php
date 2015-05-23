<?php

  namespace Mpwar\Component\Response;

  class Response extends ResponseAbstractClass
  {

    public function send()
    {
      if ($this->status != 200) {
        header('HTTP/1.0 404 Not found');
      }

      echo $this->content;
    }
  }
