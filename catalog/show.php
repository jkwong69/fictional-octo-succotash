<?php
session_start();
include 'header.php';
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
function populateTable(){
  require '../Credential.php';
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT id,item,itemprice,quality FROM shoppingcart WHERE buyername = '".$_SESSION['id']."';";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $item = $row["item"];
      $itemprice = $row["itemprice"];
      $qualityy = $row["quality"];
      $itemid = $row["id"];
      echo "<tr>
      <td>".$item."</td>
      <td>".$itemprice."</td>
      <td>".$qualityy."</td>
      <td><a href = updateitem.php?id=".$itemid."> Edit Quality </a> </td>
      <td><a href = delete.php?id=".$itemid."> Delete </a> </td>
      </tr>";
    }
  }
}


?>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../style.css">
  <style>
  body{
    background-color: #74828F;
  }
  #banner{
    display:block;
    margin:auto;
  }
  #DPbutton{

    margin: 0 auto;
  }
  a{
    color: #C25B56;
  }
  ul{
    list-style-type: none;
  }

  </style>
</head>
<body>
  <div class="container-fluid">

    <div class="row">
      <div>
        <img id = "banner" src = "Image/banner.jpg" alt = "Banner"/>
      </div>
    </div>
    <br><br><br>
    <div class="row">
      <div class="col-md-2" style="margin:10px;"><br><br>

        <ul>
          <li><a href="../home.php">Home</a></li><br>
          <li><a href="catalog.php">Browse through our catalog</a></li><br>

          <li><a href="register.php">Join our email</a></li><br>

          <li><a href="../logout">Logout</a></li><br>
        </ul>

      </div>

      <div class="col-md-6">
        <div class="panel panel-default">

          <div class="panel-body">
            <div class="dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Item Price</th>
                    <th>Quality</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  populateTable();
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>




    </div>


  </div>

</body>
</html>
