<?php

//Definir les constantes
  $hostBD = "localhost";
  $nomBD = "mmi";
  $serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";
  $userBD = 'root';         // Votre login
  $passBD = 'root';         // Votre Pass

  //connection à la base de données
  try {
    $db = new PDO($serverBD, $userBD, $passBD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
  } catch (PDOException $err) {
    die('Echec connexion DB : ' . $err->getMessage());
  }

  //requete selecte toute ma table
  function select_all() {
    global $db;

    $query = 'SELECT * FROM liste;'; //rediger requete
    $result = $db->query($query); //preparer requete
    $liste = $result->fetchAll();
    return($liste);
  }

  //insertion
  function insert($name) {
    global $db;

    try {
        $db->beginTransaction();

        $query = 'INSERT INTO liste (name) VALUES (?);'; //requete
        $request = $db->prepare($query); //prepare
        $request->execute([$name]); //execute
        $db->commit();
        $request->closeCursor();
    }
    catch (PDOException $e) {
        $db->rollBack();
        $request->closeCursor();
        die('Erreur insert CLASSE : ' . $e->getMessage());
    }
  }




//verifier si on est en post et si on a un name
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"])) {
      insert($_POST["name"]); //appel funtion insert
    }
  }


  //function qui affiche toute ma table
  $liste_entiere = select_all();
  foreach ($liste_entiere as $key => $item) {
    echo $item['name'] . '<br>';
  }

  ?>

  <body>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="text" name="name">
            <input type="submit" value="Ajouter">
      </form>
  </body>