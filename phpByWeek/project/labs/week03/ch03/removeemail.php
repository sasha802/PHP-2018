<?php

    $removeEmail = $_POST['removeEmail'];

    $dbs = mysqli_connect('localhost', 'root', '', 'elvis_store')
        or die('Error connection to the database.');


    $query = "DELETE FROM email_list
              WHERE email = '$removeEmail'";

    mysqli_query($dbs, $query)
        or die('Error executing query.');

    echo "Customer $removeEmail removed from the email list.";

    mysqli_close($dbs);
