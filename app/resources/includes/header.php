<div class="profile">
    <img src="<?=$sessionUser->photo?>">
    <h3>Bonjour <?=$sessionUser->getFullName()?></h3>
</div>
<form action="/logout" method="post">
    <input type="submit" value="Se déconnecter">
</form>