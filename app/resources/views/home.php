<?php require_once APP_ROOT . "/resources/includes/header.php" ?>


<h3>
    <a href="/user/matches">Voir tes matches</a>
    <a href="/user/likes">Voir tes likes</a>
    <a href="/user/dislikes">Voir tes dislikes</a>
</h3>

<h2>Voici tes futurs convives</h2>


<div class="userList stack">
    <div class="userCard">
        <img class="userCard-img "src="<?=$viewData["usersToLike"][0]->photo?>">
        <h3 class="userCard-name"><?= $viewData["usersToLike"][0]->getFullName();?></h3>

        <div class="userCard-actions">
            <!-- requête post pour liker -->
            <form action="/like/<?=$viewData["usersToLike"][0]->idUser?>" method="post">
                <input type="submit" value="J'aime">
            </form>

            <!-- requête post pour disliker -->
            <form action="/dislike/<?=$viewData["usersToLike"][0]->idUser?>" method="post">
                <input type="submit" value="J'aime po">
            </form>
        </div>  
    </div>
</div>

<div class="userList stack">
    <?php foreach($viewData["usersToLike"] as $i=>$user): ?>
    <div class="userCard">
        <img class="userCard-img "src="<?=$user->photo?>">
        <h3 class="userCard-name"><?= $user->getFullName();?></h3>

        <div class="userCard-actions">
            <!-- requête post pour liker -->
            <form action="/like/<?=$user->idUser?>" method="post">
                <input type="submit" value="J'aime">
            </form>

            <!-- requête post pour disliker -->
            <form action="/dislike/<?=$user->idUser?>" method="post">
                <input type="submit" value="J'aime po">
            </form>
        </div>  
    </div>
    <?php endforeach ?>
</div>