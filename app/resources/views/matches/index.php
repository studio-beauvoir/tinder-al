<?php require_once APP_ROOT . "/resources/includes/header.php" ?>

<a href="/">Retour à l'accueil</a>

<h2>Voici tes matchs</h2>

<div class="userList">
    <?php foreach($viewData["matchedUsers"] as $i=>$user): ?>
    <div class="userCard">
        <img class="userCard-img" src="<?=$user->photo?>">
        <h3 class="userCard-name"><?= $user->getFullName();?></h3>

        <!-- <div class="userCard-actions">
            <form action="/comment/<?=$user->idUser?>" method="post">
                <input type="submit" value="Ajouter un commentaire">
            </form>
        </div>   -->
    </div>
    <?php endforeach ?>
</div>