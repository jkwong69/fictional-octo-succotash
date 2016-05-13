<html>
<head>
  <?php
  include 'header.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  if (!isset($_SESSION['id'])) {
    header('location: register.php');
  }
  $_SESSION['link1pro'] = "supcont.php?link=1&pro=".getPost("pro");
  $_SESSION['link2pro'] = "supcont.php?link=2&pro=".getPost("pro");
  $_SESSION['link3pro'] = "supcont.php?link=3&pro=".getPost("pro");

  $sql = "SELECT * FROM product WHERE ProductCode like '".getPost("pro") ."';";//sql statement
  //replace space character with % (used when passing var to html link)
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
  //generate row when recieving result back from the sql execution
  function populateTable(){
    global $sql;
    require '../Credential.php';//load Credential for sql login
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //execute sql
    $result = $conn->query($sql);
    //for each row return from the sql
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $Code = $row["ProductCode"];
        $Desc = $row["ProductDesc"];
        $Price =$row["ProductPrice"];
        // set html format row
        echo "
        <div class= \"row\">
        <div class=\"col-md-4\">
          <img src=\"Image/".$Code.".jpg\" width=\"200\" height=\"200\">
        </div>
        <div class=\"col-md-6\">
        <div class= \"row\">
          ".$Desc."<br>
          $".$Price."
        </div>
        ";
        echo "
        <div class= \"row\">
        <table border = \"1\">
        <tr>
          <td> Song Title </td>
          <td> Audio Format </td>
        </tr><br>
        <tr>
          <td>".$row["song1n"]."</td>
          <td><audio src=\"song/".$row["song1"]."\" preload=\"auto\" controls></audio></td>
        </tr><br>
        <tr>
          <td>".$row["song2n"]."</td>
          <td><audio src=\"song/".$row["song2"]."\" preload=\"auto\" controls></audio></td>
        </tr>
        </table>
        </div>
        ";
      }
    }

    $conn->close();
  }
  ?>
  <link rel="stylesheet" type="text/css" href="style.css">
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
          <li><a href="index.php">Home</a></li><br>
          <li><a href="catalog.php">Browse through our catalog</a></li><br>
          
          <li><a href="register.php">Join our email</a></li><br>
          
          <li><a href="../logout.php">Logout</a></li><br>
        </ul>

      </div>

      <div class="col-md-6">

        <?php
        populateTable();
        ?>

      </div>

      <div class="col-md-2">

        <a href="<?php echo $_SESSION['link1pro'];?>"><img src="Image/add.jpg"></a><br><br>
        <a href="<?php echo $_SESSION['link2pro'];?>"><img src="Image/show.jpg"></a><br><br>
        <a href="<?php echo $_SESSION['link3pro'];?>"><img src="Image/listen.jpg"></a>

      </div>


    </div>


  </div>
<script>
$("audio").bind("stalled", function() {
     var audio = this;
     audio.load();

     // Threw in these two lines for good measure.
     audio.play();
     audio.pause();
 });
</script>
</body>
</html>
