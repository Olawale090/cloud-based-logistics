<?php

    session_start();

    $username = $_SESSION["user_name"];
    $user_avatar = $_SESSION["user_avatar"];

    if ($username == $_SESSION["user_name"]) {

        echo $_SESSION["user_name"];

    } else {

        echo "Fullname";

    }
    
?>


