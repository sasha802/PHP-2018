<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Exercise</title>
</head>
<body>
    <?php
        require_once('headerTemplate.html');
        require_once('appVariables.php');
        require_once('dbsConnectionVariables.php');
        require_once('sessionStarter.php');
        //require_once('login.php');

        $userId = $_SESSION['userId'];

        $gender = '';
        $weight = '';
        $birthdate = '';
        $caloriesBurned = null;


        $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database.');


        if ( isset($_POST['submit']) ) {

            $exerciseType = $_POST['exerciseType'];
            $exerciseDate = trim($_POST['exerciseDate']);
            $exerciseTime = trim($_POST['exerciseTime']);
            $heartRate = trim($_POST['heartRate']);


           if ( !empty($exerciseType) && !empty($exerciseDate) && !empty($exerciseTime) && !empty($heartRate) ) {

                $query = "SELECT gender, weight, birthdate
                  FROM exercise_user
                  WHERE ID = '$userId'";

                $data = mysqli_query($dbs, $query)
                or die('Error query execution');

                if ( mysqli_num_rows($data) == 1 ) {

                    $row = mysqli_fetch_array($data);
                    $gender =  $row['gender'];
                    $weight = $row['weight'];
                    $birthdate = $row['birthdate'];

                }

                $heartRateInt = intval($heartRate);
                $exerciseTimeInt = intval($exerciseTime);

                $age = date_diff(date_create($birthdate), date_create('now'))->y;


                if ( $gender === 'M' ) {

                    $calories = ((-55.0969 + (0.6309 * $heartRateInt) + (0.090174 * $weight) + (0.2017 * $age)) / 4.184) * $exerciseTimeInt;
                    $caloriesBurned = round($calories);


                } else if ( $gender === 'F' ) {

                    $calories = ((-20.4022 + (0.4472 * $heartRateInt) - (0.057288 * $weight) + (0.074 * $age)) / 4.184) * $exerciseTimeInt;
                    $caloriesBurned = round($calories);
                }

                $query = "INSERT INTO exercise_log (user_id, exercise_date, exercise_type, time_in_minutes, heartrate, calories)
                          VALUES ('$userId', '$exerciseDate','$exerciseType', '$exerciseTimeInt', '$heartRateInt', '$caloriesBurned')";

                mysqli_query($dbs, $query)
                    or die('Error running query');

                echo '<div>';
                echo '<h3>You burned ' . $caloriesBurned . ' calories</h3>';
                echo '</div>';

            }



        }

        mysqli_close($dbs);

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <label>Type of exercise</label>

        <select name="exerciseType">
            <option value=""<?php if( isset($_POST['submit']) && $exerciseType === '' ) echo 'selected' ?>>-- Select --</option>
            <option value="Ballroom Dance" <?php if( isset($_POST['submit']) && $exerciseType === 'Ballroom Dance' ) echo 'selected' ?>>Ballroom Dance</option>
            <option value="Run" <?php if( isset($_POST['submit']) && $exerciseType === 'Run' ) echo 'selected'?>>Run</option>
            <option value="Yoga" <?php if( isset($_POST['submit']) && $exerciseType === 'Yoga' ) echo 'selected' ?>>Yoga</option>
            <option value="Walk" <?php if( isset($_POST['submit']) && $exerciseType === 'Walk' ) echo 'selected' ?>>Walk</option>
        </select><br />

        <label>Date of exercise</label>
        <input type="text" name="exerciseDate" value="
            <?php
                if ( !empty($exerciseDate) ) {
                    echo $exerciseDate;
                }
            ?>
        "/><br />

        <label>Time (in minutes)</label>
        <input type="text" name="exerciseTime" value="
            <?php
                if ( !empty($exerciseTime) ) {
                    echo $exerciseTime;
                }
            ?>
        "/><br />

        <label>Average heart rate</label>
        <input type="text" name="heartRate" value="
            <?php
                if ( !empty($heartRate) ) {
                    echo $heartRate;
                }
            ?>
        "/><br /><br />

        <input type="submit" name="submit" value="Log My Exercise" />

    </form>

</body>
</html>