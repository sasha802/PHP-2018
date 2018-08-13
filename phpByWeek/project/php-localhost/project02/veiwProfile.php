<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
</head>
    <body>
        <?php
            require_once('appVariables.php');
            require_once('dbsConnectionVariables.php');

            $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database');

            $queryUserInfo = 'SELECT * 
                              FROM exercise_user';

            $userInfoResults = mysqli_query($dbs, $queryUserInfo)
                or die('Error querying user information');

            $queryExerciseInfo = 'SELECT *
                                  FROM exercise_log'
                or die('Error querying exercise information.');

            mysqli_close($dbs);


        ?>
    </body>
</html>
