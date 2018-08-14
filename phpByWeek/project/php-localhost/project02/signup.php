<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
                                  VALUES ('$userFirstName', '$userLastName', '$userGender', '$userBirthdate', $userWeight, '$userName', SHA1($password2))";
                        mysqli_query($dbs, $query);

                        echo '<p>Your new account has been successfully created. ' .
                            'You\'re now ready to log in and <a href="editProfile.php">' .
                            'edit your profile</a>.</p>';

                        mysqli_close($dbs);
                        exit();

                    } else {

                        echo '<p class="error">An account already exists for this username. ' .
                            'Please use a different address.</p>';
                        $userName = '';
                    }
                } else {

                    echo '<p class="error">You must enter all of the sign-up data, ' .
                        'including the desired password twice.</p>';
                }
            }
            mysqli_close($dbs);
        ?>

        <p>Please feel in the form to sung up for Exercise Logger</p>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >
            <fieldset>
                <legend>Exercise Logger Registration Information</legend>
                <label>First Name</label>
                <input type="text" name="firstName" value="
                    <?php
                if ( !empty($userFirstName) ) {
                    echo $userFirstName;
                }
                ?>" /><br />

                <label>Last Name</label>
                <input type="text" name="lastName" value="
                    <?php
                if ( !empty($userLastName) ) {
                    echo $userLastName;
                }
                ?>
                "/><br />

                <label>Select Yor Gender</label>
                <select name="gender">
                    <option value="">-- Select --</option>
                    <option value="F">F</option>
                    <option value="M">M</option>

                    <!--<option value="" <?php /*if( $userGender ==='' ) echo 'selected' */?>>-- Select --</option>
                    <option value="F" <?php /*if( $userGender === 'F' ) echo 'selected' */?>>F</option>
                    <option value="M" <?php /*if( $userGender === 'M' ) echo 'selected'*/?>>M</option>-->
                </select><br />

                <label>Birthdate</label>
                <input type="text" name="birthdate" value="
                    <?php
                if ( !empty($userBirthdate) ) {
                    echo $userBirthdate;
                }
                ?>
                "/><br />

                <label>Weight</label>
                <input type="text" name="weight" value="
                    <?php
                if ( !empty($userWeight) ) {
                    echo $userWeight;
                }
                ?>
                "/><br />

                <label for="userName">Usrname</label>
                <input type="text" id="userName" name="userName" value="<?php if ( !empty($userName) ) echo $userName; ?>" /><br />

                <label for="password1">Password</label>
                <input type="password" id="password1" name="password1" /><br />

                <label for="password2">Password (retype:)</label>
                <input type="password2" id="password2" name="password2" /><br />
            </fieldset>
            <input type="submit" name="submit" value="Sign Up"/>

    </body>
</html>



















