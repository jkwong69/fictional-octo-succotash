<?php
//populate campus dropdown
function listcampusDropdown(){
  require '../Credential.php';//load the path
  $str = file_get_contents($JsonCampus); //load text from file
  $json = json_decode($str,true);//decode to json var
  foreach ($json as $value){//loop through json
    echo "<option value=\"".$value['id']."\">".$value['Name']."</option>";//add option value to dropdown
  }
}

//remove special char to prevent sql injection
function TrimText($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//this function is use for set the value of the html text from "get request"
//User doesnt have retype everything out
function getPost($string){
  if( array_key_exists($string,$_GET)){
    echo replacepercent($_GET[$string]);
  }
  else{
    echo "";
  }
}

//replace space character with % (used when passing var to html link)
function replacepercent($string){
  return str_replace("%"," ",$string);
}

function replaceSpace($string){
  return str_replace(" ","%",$string);
}

?>
