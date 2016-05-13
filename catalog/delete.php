<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  //Variables
  $sql = "";

  if( array_key_exists('id',$_GET)){ //if the method is get
    $id = $_GET['id']; //set id
    $sql = "DELETE FROM musicdb.shoppingcart WHERE id= '" . $_GET['id']. "';"; //set sql command
    deleteRow(); //execute code
  }
  function deleteRow(){
    global $sql;

    require '../Credential.php';//load Credential for sql login
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) { //check connection
      die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($sql) === TRUE) {
      $conn->close();
      header('location: /catalog/show.php');
    } else {
      $conn->close();
      header('location: /catalog/show.php');
    }

  }

  ?>
