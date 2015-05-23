<?php
  include '../vendor/autoload.php';

  $bootstrap = new \Mpwar\Component\Bootstrap();
  $response = $bootstrap->execute();
  $response->send();

