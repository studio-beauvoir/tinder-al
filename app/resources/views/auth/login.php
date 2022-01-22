    <h1>Connexion</h1>

    <form class="loginForm" action="/login" method="POST">
        <label for="name">Nom de famille</label>
        <input type="text" id="name" name="name" placeholder="Coquard, Proust..."/>
        <input type="submit" value="Se connecter"/>
    </form>

    <h2>Ces utilisateurs nous ont déjà rejoints!</h2>

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