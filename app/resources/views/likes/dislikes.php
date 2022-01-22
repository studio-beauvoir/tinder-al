<?php require_once APP_ROOT . "/resources/includes/header.php" ?>

<a href="/">Retour à l'accueil</a>

<h2>Voici tes dislikes</h2>

<div class="userList">
    <?php foreach($viewData["dislikedUsers"] as $i=>$user): ?>
    <div class="userCard">
        <img class="userCard-img" src="<?=$user->photo?>">
        <h3 class="userCard-name"><?= $user->getFullName();?></h3>

        <div class="userCard-actions">
            <!-- requête post pour disliker -->
            <form action="/like/<?=$user->idUser?>" method="post">
                <input type="submit" value="Non, en fait j'aime!">
            </form>
        </div>  
    </div>
    <?php endforeach ?>
</div>