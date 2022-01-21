<?php
require_once __DIR__.'/back.php';

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        insert_user($_POST['email'], $_POST['name']);
    }
?>

<body>
    <h1>Inscription</h1>

    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <label>Email</label>
        <input type="text" name="email" value=""/>
        <label>Name</label>
        <input type="text" name="name" value=""/>

        <input type="submit" value="submit"/>
    </form>
</body>