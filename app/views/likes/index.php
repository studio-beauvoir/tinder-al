<?php

foreach($viewData["likes"] as $like) {
    echo $like->getUser()->getFullName() . " a liké ". $like->getLikedUser()->getFullName()."<br>";
}


