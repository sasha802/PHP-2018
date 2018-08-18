<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <?php require_once('bootstrapLinks.html');?>
</head>
    <body>
        <?php
            require_once('appVariables.php');
            require_once('dbsConnectionVariables.php');

            $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if ( isset($_POST['submit']) ) {

                $userFirstName = mysqli_real_escape_string($dbs, $_POST['firstName']);
                $userLastName = mysqli_real_escape_string($dbs, $_POST['lastName']);
                $userGender = mysqli_real_escape_string($dbs, $_POST['gender']);
                $userBirthdate = mysqli_real_escape_string($dbs, $_POST['birthdate']);
                $userWeight = mysqli_real_escape_string($dbs, $_POST['weight']);

                $userName = mysqli_real_escape_string($dbs, trim($_POST['userName']));
                $password1 = mysqli_real_escape_string($dbs, trim($_POST['password1']));
                $password2 = mysqli_real_escape_string($dbs, trim($_POST['password2']));

                if ( !empty($userName) && !empty($password1) && !empty($password2) && $password1 == $password2) {


                    $query = "SELECT * 
                              FROM exercise_user 
                              WHERE user_name = '$userName'";

                    $data = mysqli_query($dbs, $query)
                        or die('Error selection username');


                    if ( mysqli_num_rows($data) == 0 ) {

                        $query = "INSERT INTO exercise_user (first_name, last_name, gender, birthdate, weight, user_name, password)
                                  VALUES ('$userFirstName', '$userLastName', '$userGender', '$userBirthdate', $userWeight, '$userName', $password2)";
                        mysqli_query($dbs, $query);

                        echo '<p class="mainContainer">Your new account has been successfully created. ' .
                            'You\'re now ready to log in and<br /> <a href="editProfile.php">' .
                            'edit your profile</a>.</p>';

                        mysqli_close($dbs);
                        exit();

                    } else {

                        echo '<p class="mainContainer">An account already exists for this username.</p>';
                        $userName = '';
                    }
                } else {

                    echo '<p class="mainContainer">You must enter all of the sign-up data, ' .
                        'including the desired password twice.</p>';
                }
            }
            mysqli_close($dbs);
        ?>

        <div class="mainContainer">
            <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >
                <h3>Exercise Logger Registration Information</h3>

                <div class="form-group">
                    <label class="control-label col-sm-4">First Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="firstName" value="
                        <?php
                            if ( !empty($userFirstName) ) {
                                echo $userFirstName;
                            }
                        ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Last Name</label>
                    <div class="col-sm-8">
                    <input class="form-control" type="text" name="lastName" value="
                        <?php
                            if ( !empty($userLastName) ) {
                                echo $userLastName;
                            }
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Select Yor Gender</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="gender">
                            <option value="" <?php if( isset($_POST['submit']) && $userGender ==='' ) echo 'selected' ?>>-- Select --</option>
                            <option value="F" <?php if( isset($_POST['submit']) && $userGender === 'F' ) echo 'selected' ?>>F</option>
                            <option value="M" <?php if( isset($_POST['submit']) && $userGender === 'M' ) echo 'selected'?>>M</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Birthdate</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="birthdate" value="
                            <?php
                        if ( !empty($userBirthdate) ) {
                            echo $userBirthdate;
                        }
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Weight</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="weight" value="
                            <?php
                        if ( !empty($userWeight) ) {
                            echo $userWeight;
                        }
                        ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="userName">Usrname</label>
                    <div class="col-sm-8">
                    <input class="form-control" type="text" id="userName" name="userName" value="<?php if ( !empty($userName) ) echo $userName; ?>" /><br />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password1">Password</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" id="password1" name="password1" /><br />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="password2">Password (retype:)</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password2" id="password2" name="password2" /><br />
                    </div>
                </div>

                <button class="btn btn-success" type="submit" name="submit">Sign Up</button>
                <a href="logIn.php"><button class="btn btn-info" type="button" name="submit">Log In</button></a>
            </form>
        </div>
    </body>
</html>

















