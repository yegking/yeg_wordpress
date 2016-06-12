<?php session_start();  
$token = md5(uniqid(rand(), true));
unset($_SESSION["token"]);
$_SESSION['token'] = $token; 

$obj = new stdClass();
$obj->url = "checkcode?id=".$token;
$obj->token = $_SESSION['token'];
$obj->r = false;

echo json_encode($obj);

?>
