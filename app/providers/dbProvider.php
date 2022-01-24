<?php

//Definir les constantes
    $hostBD = DB_HOST;
    $nomBD = DB_NAME;
    $serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";
    $userBD = DB_USER;         // Votre login
    $passBD = DB_PASS;         // Votre Pass

    
    //connection à la base de données
    try {
        $db = new PDO($serverBD, $userBD, $passBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch (PDOException $err) {
        die('Echec connexion DB : ' . $err->getMessage());
    }

?>

