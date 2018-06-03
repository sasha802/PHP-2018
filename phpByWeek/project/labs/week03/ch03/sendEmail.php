<?php

    $subject = $_POST['subject'];
    $elvisEmail = $_POST['elvisMail'];

    $dbs = mysqli_connect('localhost', 'root', '', 'elvis_store')
        or die('Error connecting to the database.');

    $query = "SELECT * 
                FROM email_list";

    $queryResult = mysqli_query($dbs, $query);
        /*or die('Error running query.');*/

   while ( $row = mysqli_fetch_array($queryResult) ) {
       echo $row['first_name'] . ' '  . $row['last_name'] . ': ' . $row['email'] . '<br />';
       break;

   }


    mysqli_close($dbs);

