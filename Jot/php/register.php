<?php //register.php
session_start();

$url = "http://76.16.117.246/jot/service2.php?wsdl";
$client = new SoapClient($url);

$username = $_POST["email_insert"];
$password = $_POST["password_insert"];

$result = $client->registerNewUser($username, $password);


$token = $client->logon($username, $password);

$_SESSION["token"] = $token;
header("location: /jot/home/index.html");
?>