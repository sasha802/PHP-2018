<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
</head>
    <body>
        <?php
            require_once('headerTemplate.html');
            require_once('appVariables.php');
            require_once('dbsConnectionVariables.php');
            require_once('sessionStarter.php');

            $userId = $_SESSION['userId'];


            $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database');

            $queryUserInfo = "SELECT * 
                              FROM exercise_user
                              WHERE ID = '$userId'";

            $userInfoResults = mysqli_query($dbs, $queryUserInfo)
                or die('Error querying user information');


            $queryExerciseInfo = "SELECT *
                                  FROM exercise_log
                                  WHERE user_id = '$userId'                             
                                  ORDER BY exercise_date DESC 
                                  LIMIT 15";

            $userExerciseInfo = mysqli_query($dbs, $queryExerciseInfo)
                or die('Error querying exercise information.');

            mysqli_close($dbs);

            if ( mysqli_num_rows($userInfoResults) == 1 ) {

                $row = mysqli_fetch_array($userInfoResults);

                echo '<table>';
                    echo '<tbody>';
                        echo '<tr><th>First Name</th><td>' . $row['first_name'] . '</td></tr>';
                        echo '<tr><th>Last Name</th><td>' . $row['last_name'] . '</td></tr>';
                        echo '<tr><th>Gender</th><td>' . $row['gender'] . '</td></tr>';
                        echo '<tr><th>Birthdate</th><td>' . $row['birthdate'] . '</td></tr>';
                        echo '<tr><th>Weight</th><td>' . $row['weight'] . '</td></tr>';
                    echo '</tbody>';
                echo '</table>';
            }

            echo '<div>';
                echo '<table>';
                    echo '<tr>';
                        echo '<th>Date of exercise</th>';
                        echo '<th>Type of exercise</th>';
                        echo '<th>Time</th>';
                        echo '<th>Heart rate</th>';
                        echo '<th>Calories burned</th>';
                        echo '<th></th>';
                    echo '</tr>';

                    foreach ( $userExerciseInfo as $exerciseInfoRow ) {

                        echo '<tr>';
                            echo '<td>' . $exerciseInfoRow['exercise_date'] . '</td>';
                            echo '<td>' . $exerciseInfoRow['exercise_type'] . '</td>';
                            echo '<td>' . $exerciseInfoRow['time_in_minutes'] . '</td>';
                            echo '<td>' . $exerciseInfoRow['heartrate'] . '</td>';
                            echo '<td>' . $exerciseInfoRow['calories'] . '</td>';

                        echo '<td><a href="removeExercise.php?id=' . $exerciseInfoRow['ID'] . '">Remove</a></td>';
                        echo '</tr>';

                    }
                echo '</table>';
            echo '</div>';




        ?>
    </body>
</html>
