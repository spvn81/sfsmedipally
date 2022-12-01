<?php

session_start();
$id=$_SESSION['login_user'];
if(!isset($id)){
header('Location: index.php'); 
}

?>
