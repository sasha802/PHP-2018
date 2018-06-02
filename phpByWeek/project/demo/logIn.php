<?php


    $neededPassword = 123;
    $userName = 'S';


if (isset($_POST['userLogin']) && isset($_POST['userPassword'])) {
    if ($_POST['userLogin'] == $userName && $_POST['userPassword'] == $neededPassword) {
        if (!session_id())
            session_start();
        $_SESSION['logon'] = true;

        header('Location: nestedFormDemo.html');
        die();

    }
}

if (!session_id()) session_start();
if (!$_SESSION['logon']){
    header("Location:logIn.html");
    die();
}