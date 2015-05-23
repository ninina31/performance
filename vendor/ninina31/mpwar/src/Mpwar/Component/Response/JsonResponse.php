<?php

  namespace Mpwar\Component\Response;

  class JsonResponse extends ResponseAbstractClass
  {

    public function send()
    {
      if ($this->status != 200) {
        header('HTTP/1.0 404 Not found');
      }

      header('Content-Type: application/json');

      if (!is_array($this->content)) {
        $this->content = array($this->content);
      }

      echo json_encode($this->content);
    }
  }
