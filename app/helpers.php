<?php


function DBExec($query, $params) {
    global $db;

    $request = '';
    
    // query à bind;
    $query = $db->prepare($request);

    // on bind les parametres un à un
    // i va de 1 à longueur de(params)
    // chaque paramètre doit avoir la forme [valeur, type]
    for($i=1; $i<=count($params); $i++) {
        $query->bindValue($i, $params[$i][0], $params[$i][1]);
    }

    $query->execute();
    $query->closeCursor();

    $query = 'SELECT * FROM user;'; 

    // on passe le query à la bdd
    $result = $db->query($query);

    // on recup le resultat
    $users = $result->fetchAll();
    
}

function DBQueryAll($query) {
    global $db;
    
    // on passe le query à la bdd
    $result = $db->query($query);

    // on recup les resultat
    $queryResults = $result->fetchAll();

    return $queryResults;
}

function DBQuery($query) {
    global $db;

    // on passe le query à la bdd
    $result = $db->query($query);

    // on recup le resultat
    $queryResult = $result->fetch();
    return $queryResult;
}