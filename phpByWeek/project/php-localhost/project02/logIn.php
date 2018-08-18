<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
    <?php require_once('bootstrapLinks.html')?>
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
                         echo '<p class="mainContainer">User does not exist. Please sign up <a href="signup.php">Sing up</a></p>';
                     }

                } else {

                    echo '<p class="mainContainer">User does not exist. Please sign up <a href="signup.php">Sing up</a></p>';
                }

                mysqli_close($dbs);

            } else {
                echo '<p class="mainContainer">Please enter your username and password.</p>';
            }


        }
    ?>
        <div class="mainContainer">
            <form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">

                <div class="form-group">
                    <label class="control-label col-sm-5" for="username">Username:</label>
                    <div class="col-sm-7">
                        <input class="control-label" type="text" name="username" /><br />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5" for="password">Password:</label>
                    <div class="col-sm-7">
                        <input class="control-label" type="password" name="password" /><br />
                    </div>
                </div>

                <button class="btn btn-info" type="submit" name="submit">Log In</button>
                <a href="signup.php"><button class="btn btn-success" type="button" name="submit">Sign Up</button></a>
            </form>
        </div>

    </body>
</html>

