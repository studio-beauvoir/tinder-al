<?php require_once APP_ROOT . "/resources/includes/header.php" ?>


<h3 class="actions">
    <a href="/user/matches">Matchs</a>
    <a href="/user/likes">Tes likes</a>
    <a href="/user/dislikes">Tes dislikes</a>
</h3>

<a class="cta-1" href="/discover">Faire des rencontres !</a>


<h2>Voici des gens chauds de ta région</h2>

<div class="userList stack">
    <?php foreach($viewData["users"] as $i=>$user): ?>
    <div class="userCard">
        <img class="userCard-img "src="<?=$user->photo?>">
        <h3 class="userCard-name"><?= $user->getFullName();?></h3>

        <div class="userCard-actions">
        </div>  
    </div>
    <?php endforeach ?>
</div>