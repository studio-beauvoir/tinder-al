<h1>Utilisateurs disponibles de la plateforme</h1>
<?php
// objectif : afficher des gens à liker

foreach($viewData["usersToLike"] as $user) {
    echo $user->getFullName() ."<br>";
}

var_dump($sessionUser->getFullName());
var_dump($sessionUser->DBUpdateOnSelf([
    'biographie'=>'Tes sqqsdt'
]));

?>
