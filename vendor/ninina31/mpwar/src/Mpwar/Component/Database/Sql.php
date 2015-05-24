<?php

  namespace Mpwar\Component\Database;
  use Mpwar\Component\Database\DBInterface;
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
        $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
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
        
        $this->executeQuery();
        
        $row = $this->fetchAll();
      
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
        
        $this->executeQuery();
        
        $row = $this->fetchAll();
      
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
          
        $query = "select m.nombre from municipios m, provincias p where p.id_provincia = m.id_provincia and p.provincia like ? COLLATE utf8_general_ci";

        $this->prepareQuery($query);

        $this->bindParameters(1, urldecode($name) . '%');

        $this->executeQuery();

        $row = $this->fetchAll();

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
        
        $this->prepareQuery($query);
        
        $this->bindParameters(1, $pc);
        
        $this->executeQuery();

        $row = $this->fetch();
      
        return $row;
      }
      //to handle error
      catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
      }
    }

  }
