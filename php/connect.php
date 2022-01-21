<?php

//Definir les constantes
  $hostBD = "localhost";
  $nomBD = "tinder";
  $serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";
  $userBD = 'root';         // Votre login
  $passBD = '';         // Votre Pass

  //connection à la base de données
  try {
    $db = new PDO($serverBD, $userBD, $passBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
  } catch (PDOException $err) {
    die('Echec connexion DB : ' . $err->getMessage());
  }

  session_start();
  $_SESSION['username'] = $_GET['userN']; //récupère l'entrée danns index.html

  if(isset($_SESSION["NAME"])) {
    echo "Welcome " . $_SESSION["NAME"] . " !";
  }
  else {
      echo "Wrong username";
  }

  session_destroy(); //dès qu'on start, écrire destroy

?>

