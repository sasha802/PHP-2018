<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>

    <?php

        require_once('appVariables.php');
        require_once('dbsConnectionVariables.php');

        $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting to MySQL Server.');

        $sqlImage = "SELECT image_name 
                     FROM exercise_user
                     WHERE user_name = 'test_user_name'";

        $sqlResults = mysqli_query($dbs, $sqlImage);

        mysqli_close($dbs);


        echo '<div>';
            foreach ( $sqlResults as $row ) {
                echo '<p><img src="' . SC_UPLOADPATH . $row['image_name'] . '" alt="User Profile Image"></p>';
            }
        echo '</div>';


        if ( isset($_POST['submit']) ) {

            $userFirstName = $_POST['firstName'];
            $userLastName = $_POST['lastName'];
            $userGender = $_POST['gender'];
            $userBirthdate = $_POST['birthdate'];
            $userWeight = $_POST['weight'];

            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageTmpLocation = $_FILES['image']['tmp_name'];


            if ( !empty($userFirstName) && !empty($userLastName) && !empty($userGender) && !empty($userBirthdate)
                && !empty($userWeight) ) {

                if ( (($imageType == 'image/gif') || ($imageType == 'image/jpeg') || ($imageType == 'image/pjpeg')
                    || ($imageType == 'image/png') && ($imageSize > 0) && ($imageSize <= SC_MAXFILESIZE)) ) {

                    if ( $imageError == 0 ) {

                        $targetImgLocation = SC_UPLOADPATH . $imageName;

                        if ( move_uploaded_file($imageTmpLocation, $targetImgLocation) ) {

                            $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or die('Error connecting to MySQL Server.');


                            $sql = "INSERT INTO exercise_user (first_name, last_name, gender, birthdate, weight, image_name) 
                                    VALUES ('$userFirstName', '$userLastName', '$userGender', '$userBirthdate', '$userWeight', '$imageName')";

                            mysqli_query($dbs, $sql)
                                or die('Error inserting into ' . DB_NAME . 'database');

                            $userFirstName = '';
                            $userLastName = '';
                            $userGender = '';
                            $userBirthdate = '';
                            $userWeight = '';

                            mysqli_close($dbs);

                        } else {
                            echo '<p>Error moving image file</p>';
                        }

                    } else {
                        echo '<p>Error uploading an image.</p>';
                    }

                } else {
                    echo '<p>Your image has to have one of the extensions (.gif, .jpeg, .pjpeg, .png)</p>';
                }

            } else {
                echo '<p>Please enter all the form information.</p>';
            }
        }

    ?>
    <div>
        <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >

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
                <option value="" <?php if( $userGender ==='' ) echo 'selected' ?>>-- Select --</option>
                <option value="F" <?php if( $userGender === 'F' ) echo 'selected' ?>>F</option>
                <option value="M" <?php if( $userGender === 'M' ) echo 'selected'?>>M</option>
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

            <input type="hidden" name="MAX_FILE_SIZE" /><br />
            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="image" />
            <hr />

            <input type="submit" name="submit" value="Save Profile"/>

        </form>
    </div>
    <a href="index.html">Home</a>

</body>
</html>


