<?php
    require_once('dbsConnectionVariables.php');

    $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting to the database');


    if ( isset($_GET['id']) ) {

        $exerciseId = $_GET['id'];


        $query = "DELETE 
                  FROM exercise_log
                  WHERE ID = '$exerciseId'";

        mysqli_query($dbs, $query);

        header('Location: viewProfile.php');

        mysqli_close($dbs);

    }

