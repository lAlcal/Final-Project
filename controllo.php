<?php

$campo = $_GET["campo"];
$valore = $_GET["valore"];
$connection=new mysqli("localhost","root","","prova");

$query = "SELECT $campo FROM utenti WHERE $campo = '$valore'";
$result=$connection->query($query);
if($result -> num_rows != 0)
{
   echo true;
}
$connection->close();
?>