<?php

if ( empty($_SESSION) ) {
    session_start();
}

if ( !isset($_SESSION['userId']) ) {
    header("Location: index.php");
    exit;
}