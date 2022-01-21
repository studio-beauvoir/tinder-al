<?php

require_once __DIR__.'../app/provider/db.php'; //le chemin pour connecter à db.php

//copier back.php de l'ancien projet

function insert_user($email, $name) {
    global $db;

    try {
        $d²b->beginTransaction();

        $query = 'INSERT INTO liste (email, name) VALUES (?,?);'; //requete
        $request = $db->prepare($query); //prepare
        $request->execute([$name, $name]); //execute
        $db->commit();
        $request->closeCursor();
    }
    catch (PDOException $e) {
        $db->rollBack();
        $request->closeCursor();
        die('Erreur insert CLASSE : ' . $e->getMessage());
    }
}

function connect_user($email) {
    global $db;

    $query = 'SELECT * FROM users WHERE email = ?;';
    $result = $db->prepare($query);
    $result->execute([email]);
    $user = $result->fetch();

    if($user) {
        setcookie('user', $user['email']);
        header('Location: home.php'); //dès qu'on créé le cookie, on part sur le home.php
    }

    print_r($user);
}

function get_user_name($email) {
    global $db;

    $query = 'SELECT * FROM users WHERE email = ?;';
    $result = $db->prepare($query);
    $result->execute([email]);
    $user = $result->fetch();

    return $user['name'];
}

?>