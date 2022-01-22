<h1>Bonjour <?=$sessionUser->getFullName()?></h1>
<form action="/logout" method="post">
    <input type="submit" value="Se déconnecter">
</form>