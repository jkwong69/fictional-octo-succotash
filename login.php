<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
if ($_SERVER["REQUEST_METHOD"] == "POST") { //If post request was called
  /*
  if statement are use to check if the text field of the html are empty
  if they are, set the error variables to display the error
  else remove special header and set its to the variables
  */

  $loginUsername  = TrimText($_POST["username"]);
  $Loginpassword = TrimText($_POST["password"]);
  //Check if the variable are empty, if they are that means that the html text-danger
  //are empty, This check prevent sql statement from executing if Name, Abb, and CampusID
  //are empty

  if($loginUsername != "" && $Loginpassword != "" ){
    // Connection Data
    require 'Credential.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM account WHERE Username = '".$loginUsername."';"; //set query statement
    $result = $conn->query($sql); //execute query


    if ($result->num_rows > 0) {//for each row return from the sql
      if($row = $result->fetch_assoc())// output data of each row in assoc array
      {

        if(var_export(hash_equals($Loginpassword, $row['pass']), true)){ //check if the result matched with the store hash password
          $_SESSION["id"] = $row['Username']; //create session id using the rank
          $_SESSION["Username"] = $row['Username']; //and set username
          header('Location: /home.php'); //redirect to header , main page
        }
      }
    }
    else{
      header('Location: /login.php?msg=' . urlencode(base64_encode("Incorrect Username and Password Combination"))); //no user was found Incorrect password or username
    }

  }
}
function TrimText($data) {//remove special char to prevent sql injection
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
