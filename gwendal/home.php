<?php
require_once  __DIR__.'/back.php';
?>

<h1>Coucou tu es loggé en tant que <?php echo(urldecode($_COOKIE['user']))?></h1>
<h2>Votre nom est <?php echo(get_user_name(urldecode($_COOKIE['name'])))?></h2>