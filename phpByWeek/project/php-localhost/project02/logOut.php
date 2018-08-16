<?php
    require_once('headerTemplate.html');
    require_once('sessionStarter.php');

    unset($_SESSION['userId']);
    session_destroy();

    header("Location: index.php");