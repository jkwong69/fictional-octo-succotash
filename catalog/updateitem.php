<?php
include 'header.php';

if($_GET['id'] != null)
  $ide = $_GET['id'];
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

            <div class="container">
              <h2>Update Quality</h2>
              <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <!-- id -->
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="id" name="id" value="<?php global $ide; echo $ide;?>">
                    </div>
                  </div>
                  <!-- Name -->
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Quality</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="quality" name="quality">
                    </div>
                  </div>

                  <!-- Sumbit Button -->
                  <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                      <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-query">
                    </div>
                  </div>

                </form>

              </div>
            </div>
            <?php
            global $ide;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              include '../globalphpfunction.php';
              $Id = TrimText($_POST["id"]);
              $quality = TrimText($_POST["quality"]);

              require '../Credential.php';
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "
              UPDATE musicdb.shoppingcart SET
              quality = '".$quality."'
              WHERE
              id = '".$Id."';";

              if ($conn->query($sql) === TRUE) {
                $conn->close();
                echo "<script>window.location = \"show.php\";</script>";
              }
            }
            ?>

          </div>
        </div>
      </div>



    </div>


  </div>

</body>
</html>
