<?php

include "classes.php";

$klasa = new Configuration();

try
{
 $oConnection = new PDO("mysql:host=$klasa->host;dbname=$klasa->dbname", $klasa->username, $klasa->password);
 //echo "Connected to $klasa->dbname at $klasa->host successfully.";
}
catch (PDOException $pe)
{
 die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>