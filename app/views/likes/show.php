<h1>Likes de <?=$sessionUser->getFullName() ?></h1>

<?php

foreach($viewData['likesFromOne'] as $like) {
    echo  $like->getLikedUser()->getFullName() . "<br>";
}

?>