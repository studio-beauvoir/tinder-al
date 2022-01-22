<?php require_once APP_ROOT . "/resources/includes/header.php" ?>


<h3>
    <a href="/home">Retour aux futurs convives</a>
</h3>

<h2>Voici tes likes</h2>

<div class="userList">
    <?php foreach($viewData["likedUsers"] as $i=>$user): ?>
    <div class="userCard">
        <img class="userCard-img" src="<?=$user->photo?>">
        <h3 class="userCard-name"><?= $user->getFullName();?></h3>

        <div class="userCard-actions">
            <!-- requête post pour disliker -->
            <form action="/dislike/<?=$user->idUser?>" method="post">
                <input type="submit" value="En fait j'aime po">
            </form>
        </div>  
    </div>
    <?php endforeach ?>
</div>