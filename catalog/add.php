<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

function replaceSpace($string){
  return str_replace(" ","%",$string);
}
function getPost($string){
  if( array_key_exists($string,$_GET)){
    return replaceSpace($_GET[$string]);
  }
  else{
    return "";
  }
}



if ((!isset($_SESSION['id']))) {
  header('location: ../register.php');
  exit();
}
else{

  require '../Credential.php';
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  //$sql = "SELECT * FROM shoppingcart WHERE buyername = '".$_SESSION['id']."' and item = '".getPost('pro')."';";
  //$result = $conn->query($sql);
  //
  // if ($result->num_rows > 0) {
  //   echo "<script>window.location = \"show.php\";</script>";
  // }

    $sql = "SELECT * FROM musicdb.product where ProductCode = '".getPost('pro')."' ;";
    $result = $conn->query($sql);


    $row = $result->fetch_assoc();
    $rowpprice = $row['ProductPrice'];

    $sql = "SELECT * FROM musicdb.shoppingcart Where buyername = '". $_SESSION['id'] ."' and item = '".getPost('pro')."' ;";
    $result = $conn->query($sql);

    if ($result -> num_rows > 0){
      $sqlRow = $row['id'];
      $qual1 = $row['quality'] + 1;
      $sql = "UPDATE INTO musicdb.shoppingcart (`item`,`itemprice`,`buyername`,`quality`)VALUES(
      '".getPost('pro')."',
      '".$row['ProductPrice']."',
      '".$_SESSION['id']."',
      '".$qual1."') WHERE id = '".$sqlRow ."' ;";
      $result = $conn->query($sql);
    }
    else {
      $sql = "INSERT INTO musicdb.shoppingcart (`item`,`itemprice`,`buyername`,`quality`)VALUES(
      '".getPost('pro')."',
      '".$rowpprice."',
      '".$_SESSION['id']."',
      '1');";
      //echo '<p> '.$sql.' </p>';
      $result = $conn->query($sql);
    }
    $conn->close();
    header('location: /catalog/show.php');
}
?>
