<html>
<head>
  <?php
  // if (!isset($_SESSION['id'])) {

  include 'header.php';
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $sql = "SELECT * FROM product WHERE ProductCode like '".getPost("productCode") ."';";//sql statement
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
  if ($_SERVER["REQUEST_METHOD"] == "POST") {//If post request was called
    $_SESSION['id'] = $_POST["First"];
    $_SESSION['last'] = $_POST["Last"];
    $_SESSION['email'] = $_POST["Email"];

    $_SESSION['cart'] = array();

    //unset($_SESSION['cart'][$id]); //remove the item from the cart

     echo "<script>window.location = \"catalog.php\";</script>";
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
          <li><a href="../home.php">Home</a></li><br>
          <li><a href="catalog.php">Browse through our catalog</a></li><br>
          
          <li><a href="register.php">Join our email</a></li><br>
          
        </ul>

      </div>

      <div class="col-md-6">
        <h1>Download registration</h1> <p>Before you can download and listen to these sound files, you must register with us by entering your name and email address below.</p>
        <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <!-- Make -->
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="make" name="First"required>
            </div>
          </div>
          <!-- Model -->
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Last namme</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="model" name="Last" required>
            </div>
          </div>
          <!-- Type  -->
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Email Address</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="type" name="Email" required="">
            </div>
          </div>


          <!-- Sumbit Button -->
          <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">
            </div>
          </div>

        </form>

      </div>


    </div>


  </div>

</body>
</html>
