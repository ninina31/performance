<?php

  namespace Mpwar\Component\Database;
  use Mpwar\Component\Cache\MemoryCache;
  use PDO;

  class Sql implements DBInterface
  {
    protected $host;
    protected $db_name;
    protected $username;
    protected $password;
    protected $connection;
    protected $statement;

    function __construct($host="localhost", $db_name="performance", $username="root", $password="ninina31")
    {
      $this->host = $host;
      $this->db_name = $db_name;
      $this->username = $username;
      $this->password = $password;
    }

    public function connect()
    {
      
      try {
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
      }
      catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
      }

    }

    protected function prepareQuery($query)
    {
      $this->statement = $this->connection->prepare( $query );
    }

    protected function bindParameters($pos, $param)
    {
      $this->statement->bindParam($pos, $param);
    }

    protected function executeQuery()
    {
      return $this->statement->execute();
    }

    protected function countRows()
    {
      return $this->statement->rowCount();
    }

    protected function fetch()
    {
      return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    protected function fetchAll()
    {
      return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function isSingleResult()
    {
      return $this->countRows() == 1;
    }

    public function getProvinces()
    {
      try{
        $this->connect();
          
        $query = "select * from provincias";

        $this->prepareQuery($query);

        $cache = new MemoryCache();

        $keyName = $cache->getKeyName(array('getProvinces'));

        $cache_result = $cache->get($keyName);

        if (!empty($cache_result)) {
          return $cache_result;
        }
        
        $this->executeQuery();
        
        $row = $this->fetchAll();

        $cache->set($keyName, $row, 30);
      
        return $row;
      }
      //to handle error
      catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
      }
    }

    public function getMunicipalities()
    {
      try{
        $this->connect();
          
        $query = "select nombre as `name` from municipios";
        $this->prepareQuery($query);

        $cache = new MemoryCache();

        $keyName = $cache->getKeyName(array('getMunicipalities'));

        $cache_result = $cache->get($keyName);

        if (!empty($cache_result)) {
          return $cache_result;
        }
        
        $this->executeQuery();
        
        $row = $this->fetchAll();

        $cache->set($keyName, $row);
      
        return $row;
      }
      //to handle error
      catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
      }
    }

    public function getMunicipalityByProvince($name)
    {
      try{
        $this->connect();
          
        $query = "select m.nombre from municipios m, provincias p where p.id_provincia = m.id_provincia and p.provincia like ?";

        $this->prepareQuery($query);

        $parsedName = urldecode($name) . '%';

        $this->bindParameters(1, $parsedName);

        $cache = new MemoryCache();

        $keyName = $cache->getKeyName(array('getMunicipalityByProvince', $parsedName));

        $cache_result = $cache->get($keyName);

        if (!empty($cache_result)) {
          return $cache_result;
        }

        $this->executeQuery();

        $row = $this->fetchAll();

        $cache->set($keyName, $row);

        return $row;
      }
      //to handle error
      catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
      }
    }

    public function getMunicipalityFromPC($pc)
    {
      try{
        
        $this->connect();
          
        $query = "select p.provincia from provincias p where p.id_provincia = ?";

        $cache = new MemoryCache();

        $keyName = $cache->getKeyName(array('getMunicipalityFromPC', $pc));

        $cache_result = $cache->get($keyName);

        if (!empty($cache_result)) {
          return $cache_result;
        }
        
        $this->prepareQuery($query);
        
        $this->bindParameters(1, $pc);
        
        $this->executeQuery();

        $row = $this->fetch();

        $cache->set($keyName, $row);
      
        return $row;
      }
      //to handle error
      catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
      }
    }

  }
