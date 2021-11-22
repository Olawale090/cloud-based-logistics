<?php

    session_start();

    $username = $_SESSION["user_name"];

    if ($username == $_SESSION["user_name"]) {

        echo $_SESSION["user_name"];

    } else {

        echo "Fullname";

    }
    
?>


