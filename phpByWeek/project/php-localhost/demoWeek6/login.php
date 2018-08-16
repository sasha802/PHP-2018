<?php
/*    require_once('headerTemplate.html');
    require_once('dbsConnectionVariables.php');

    if ( !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ) {

        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="ExerciseLogger"');
        exit('<h3>Exercise Logger</h3>Sorry, you must enter your username and password to log ' .
            'in and access this page. If you aren\'t a registered member, please ' .
            '<a href="signup.php">sign up</a>.
             <a href="index.php">Home</a>');

    }

    $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,  DB_NAME);

    $userUerName = mysqli_real_escape_string($dbs, trim($_SERVER['PHP_AUTH_USER']));
    $userPassword = mysqli_real_escape_string($dbs, trim($_SERVER['PHP_AUTH_PW']));

    $query = "SELECT ID, user_name
              FROM exercise_user
              WHERE user_name = '$userUerName'
              ANd password = SHA1('$userPassword')";

    $data = mysqli_query($dbs, $query);

    if ( mysqli_num_rows($data) == 1 ) {

        $row = mysqli_fetch_array($data);
        $userId = $row['ID'];
        $userName = $row['user_name'];

    } else {

        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="ExerciseLogger"');

        exit('<h2>Exercise Logger</h2>Sorry, you must enter a valid username and password to log ' .
            'in and access this page. If you aren\'t a registered member, please ' .
            '<a href="signup.php">sign up</a>.');
    }

    echo '<p>You are logged in as ' . $userName . '</p>';*/
