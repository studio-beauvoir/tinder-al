<a href="/">Retour à l'accueil</a>

<h1>Découvre des gens!</h1>
<h3>Alors alors?</h3>

<?php if($viewData["isUser"]) : ?>
<div class="userList stack">
    <div class="userCard">
        <img class="userCard-img "src="<?=$viewData["userToLike"]->photo?>">
        <h3 class="userCard-name"><?= $viewData["userToLike"]->getFullName();?></h3>

        <div class="userCard-actions">
            <!-- requête post pour liker -->
            <form action="/like/<?=$viewData["userToLike"]->idUser?>" method="post">
                <input type="submit" value="J'aime">
            </form>

            <!-- requête post pour disliker -->
            <form action="/dislike/<?=$viewData["userToLike"]->idUser?>" method="post">
                <input type="submit" value="J'aime po">
            </form>
        </div>  
    </div>
</div>

<?php else: ?>
    <p>Ah, il n'y a plus personne!</p>
<?php endif; ?>