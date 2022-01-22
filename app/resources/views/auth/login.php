<body>
    <h1>Connexion</h1>

    <form action="/login" method="POST">
        <label>Nom</label>
        <input type="text" name="name" placeholder="Allez"/>
        <input type="submit" value="submit"/>
    </form>

    <h3>Ces utilisateurs nous ont déjà rejoints!</h3>
    <ul>
        <?php foreach($viewData["users"] as $user) {
            echo "<li>".$user->nomEUser."</li>";
        }
        ?>
    </ul>
</body>