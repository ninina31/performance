<?php

  namespace Mpwar\Component\Database;

  interface DBInterface
  {
    
    public function connect();
    public function getItem($id);
    public function insertItem($name);
    public function updateItem($id, $name);
    public function deleteItem($id);
  }

?>
