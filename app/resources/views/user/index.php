<?php

echo "view index\n";
foreach($viewData["users"] as $user) {
    echo $user->nomEUser."\n";
    echo $user->getGenreModel()->libGenr."\n";
}

