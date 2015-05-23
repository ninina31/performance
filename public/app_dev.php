<?php
  include '../vendor/autoload.php';

  error_reporting( -1 );
  ini_set( "display_errors", "on" );

  $bootstrap = new \Mpwar\Component\Bootstrap();
  $response = $bootstrap->execute();
  $response->send();
