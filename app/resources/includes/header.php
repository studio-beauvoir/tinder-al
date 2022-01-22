<h1>
    Bonjour <?=$sessionUser->getFullName()?>
    <img width=40 src="<?=$sessionUser->photo?>">
</h1>
<form action="/logout" method="post">
    <input type="submit" value="Se déconnecter">
</form>