<?php
    require_once __DIR__.'/back.php';

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        connect_user($_POST['email']);
}
?>

<body>
    <h1>Connexion</h1>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <label>Email</label>
        <input type="text" name="email" value=""/>²
        <input type="submit" value="submit"/>
    </form>
</body>