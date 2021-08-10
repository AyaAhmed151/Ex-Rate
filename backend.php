<?php 
  session_start();
  ob_start();
  define('base_url', 'http://localhost/ex_rate/');

  
  function url($var = null)
  {
    return base_url.$var;
  }

  //connection DB
  function conn()
  {
    $dsn = 'mysql:host=localhost;dbname=ex_rate';
    $pdo = new PDO($dsn , 'root' , '');
    return $pdo;
  }

  // get all data from DB
  function selectall($table)
  {
    $sql = "SELECT * FROM $table ";
    $stmt = conn()->query($sql);
    return $stmt; 
  }
  // get all data from DB with condition
  function select ($table,$condition)
  {
    $sql = "SELECT * FROM $table WHERE $condition";
    $stmt = conn()->query($sql);
    return $stmt;
  }

  function moveimage($name) {
    $target_dir = 'images/';
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
      return $_FILES[$name]["name"];
    } 
  }

  //insert in DB
  function insert($table, $column, $data)
  {
    $stmt = conn()->query("INSERT INTO $table ($column) VALUES ($data)");
    if ($stmt) {
      return true;
    }
  }
  
  //update in DB
  function update($table, $columns, $id)
  {
    $sql = "UPDATE $table SET $columns  WHERE `id`='$id'";
    $stmt = conn()->query($sql);
    if ($stmt) {
      return true;
    }
  }
  //delete item
  function delete($table , $id)
    {
      $sql = "DELETE FROM $table WHERE `id`='$id'";
      $stmt = conn()->query($sql);
      if ($stmt) {
        return true;
      } else {
        return false;
      }
    }
/////////////////////////////////////////////////////
  
?>