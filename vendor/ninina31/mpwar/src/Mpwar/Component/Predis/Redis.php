<?php

namespace Mpwar\Component\Predis;
require "src/autoloader.php";

class Redis
{
    public function __construct()
    {
        
    }

    public function connect()
    {
        try {

           shell_exec('/usr/local/bin/redis-server');
           echo "Se levanto el redis";

        \Predis\Autoloader::register();
        $connection = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.1.1.0',
            'port' => '6379'
        ]);

        } catch (\Predis\Connection\ConnectionException $e) {

            echo $e->getMessage();
            echo "No se conecto";
         }

        return $connection;
    }
}