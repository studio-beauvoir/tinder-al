<?php

foreach($viewData['allUsers'] as $userToCheck) {
    if($userToCheck->checkMatch($viewData["user_id"])) {
        echo $userToCheck->getFullName();
    }
}
?>