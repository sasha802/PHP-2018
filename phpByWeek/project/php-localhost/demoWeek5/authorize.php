<?php
    //Set username and password
    $username = 'stool';
    $password = '12345';

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != $username || $_SERVER['PHP_AUTH_PW'] != $password) {

        // Username AND/OR Password are incorrect; send the authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Stool Collection"');
        exit('<h2>Stool Collection</h2>You must enter a valid user name and password to access');

    }