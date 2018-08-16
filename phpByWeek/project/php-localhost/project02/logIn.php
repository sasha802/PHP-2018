<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
</head>
    <body>
    <?php
        require_once('dbsConnectionVariables.php');

        $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting to the database');

        if ( empty($_SESSION) ) {
            session_start();
        }

        if ( isset($_SESSION['username']) ) {
            header("location: viewProfile.php");
            exit;
        }


        if ( isset($_POST['submit']) ) {

            $userNameInput = mysqli_real_escape_string($dbs, trim($_POST['username']));
            $passwordInput = mysqli_real_escape_string($dbs, trim($_POST['password']));

            $passwordInputInt = intval($passwordInput);


            if ( !empty($userNameInput) && !empty($passwordInputInt) ) {

                $query = "SELECT ID, user_name, password
                  FROM exercise_user
                  WHERE user_name = '$userNameInput'
                  AND password = '$passwordInputInt'";

                $data = mysqli_query($dbs, $query)
                    or die('Error selecting user info.');

                if ( mysqli_num_rows($data) == 1 ) {

                     $row = mysqli_fetch_array($data);
                     $userId = $row['ID'];
                     $userName = $row['user_name'];
                     $userPassword = $row['password'];


                     if ( $userName == $userNameInput && $userPassword == $passwordInputInt) {

                        $_SESSION['userId'] = $userId;
                         header("Location: viewProfile.php");
                         exit;

                     } else {
                         echo 'User does not exist. Please sign up <a href="signup.php">Sing up</a>';
                     }

                } else {

                    echo 'User does not exist. Please sign up <a href="signup.php">Sing up</a>';
                }

                mysqli_close($dbs);

            }


        }



    ?>

    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" /><br />
        <label for="password">Password:</label>
        <input type="password" name="password" /><br />
        <input type="submit" name="submit" value="Login" />

    </form>
    </body>
</html>

