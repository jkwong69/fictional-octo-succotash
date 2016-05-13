<?php
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
  header('location: register.php');
  exit();
}
else{
  if (getPost('link') == 1){
    header('location: add.php?pro='.getPost('pro'));
  }
  elseif (getPost('link') == 2){
    header('location: show.php?pro='.getPost('pro'));
  }
  elseif (getPost('link') == 3){
    header('location: listen.php?pro='.getPost('pro'));
  }
}
?>
