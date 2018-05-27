<?php

    $dbs = mysqli_connect('localhost', 'root', '','elvis_store')
        or die ('Error connecting to MySQL server.');

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];


    $query = "INSERT INTO email_list(first_name, last_name, email)" .
            "VALUES('$firstName', '$lastName', '$email')";

    mysqli_query($dbs, $query)
    or die ('Error querying database.');

    echo 'Customer added';

    mysqli_close($dbs);