<?php require_once APP_ROOT . "/resources/includes/header.php" ?>


<h3>
    <a href="/home">Retour aux futurs convives</a>
</h3>

<h3>Voici tes matchs</h3>

<div style="display:flex; flex-flow:row wrap; gap:2rem">
    <?php foreach($viewData["matchedUsers"] as $i=>$user): ?>
    <div>
        <img height=300 width=200 src="<?=$user->photo?>?random=<?=$i?>">
        <h3><?= $user->getFullName();?></h3>

        <div style="display:flex; flex-flow:row">
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