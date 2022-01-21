<?php

echo "view index";
print_r($users);
foreach($users as $user) {
    echo $user->nomEUser;
}