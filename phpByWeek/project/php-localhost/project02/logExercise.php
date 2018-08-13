<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Exercise</title>
</head>
<body>
    <?php
        require_once('appVariables.php');
        require_once('dbsConnectionVariables.php');

        if ( isset($_POST['submit']) ) {

            $exerciseType = $_POST['exerciseType'];
            $exerciseDate = $_POST['exerciseDate'];
            $exerciseTime = $_POST['exerciseTime'];
            $heartRate = $_POST['heartRate'];

            var_dump($exerciseType);

            if ( !empty($exerciseType) && !empty($exerciseDate) && !empty($exerciseTime) && !empty($heartRate) ) {
               $heartRateInt = intval($heartRate);

            }



        }

    ?>







    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <label>Type of exercise</label>

        <select name="exerciseType">
            <option value=""<?php if( $exerciseType == '' ) echo 'selected' ?>>-- Select --</option>
            <option value="Ballroom Dance" <?php if( $exerciseType == 'Ballroom Dance' ) echo 'selected' ?>>Ballroom Dance</option>
            <option value="Run" <?php if( $exerciseType == 'Run' ) echo 'selected'?>>Run</option>
            <option value="Yoga" <?php if( $exerciseType == 'Yoga' ) echo 'selected' ?>>Yoga</option>
            <option value="Walk" <?php if( $exerciseType == 'Walk' ) echo 'selected' ?>>Walk</option>
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
    <a href="index.html">Home</a>
</body>
</html>