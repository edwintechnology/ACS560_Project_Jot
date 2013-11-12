<?php //login.php
session_start();

$url = "http://76.16.117.246/jot/service2.php?wsdl";
$client = new SoapClient($url);

$username = $_POST["user"];
$password = $_POST["pass"];

$result = $client->logon($username, $password);

if($result == "")
 header("location: /jot/php/error.php");
else{
 $_SESSION["token"] = $result; 
 header("location: /jot/home/index.php");
}
?>
