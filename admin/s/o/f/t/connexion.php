<?php
  $serveur='localhost';
  $user='root';
  $passw='';
  $base='pagires_bdd';
  $bd = new mysqli($serveur, $user, $passw, $base);

  //check connexion

  if ($bd->connect_error){
    die ("Connection failed:".$bd->connect_error);
  }
  //change character set to utf

  mysqli_set_charset($bd,"utf8");

  //change character set to utf


?>