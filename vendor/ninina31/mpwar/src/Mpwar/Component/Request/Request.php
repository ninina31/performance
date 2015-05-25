<?php 

  namespace Mpwar\Component\Request;
  use Mpwar\Component\Session\Session;

  class Request
  {
    
    public $get;
    public $post;
    public $cookies;
    public $server;
    public $session;
	public $route;

    public function __construct()
    {
      $session = new Session();
      $this->get = new Parameters($_GET);
      $this->post = new Parameters($_POST);
      $this->cookies = new Parameters($_COOKIE);
      $this->server = new Parameters($_SERVER);
      $this->session = $session;

      $_GET = $_POST = $_COOKIE = $_SERVER = null;
    }
  }
