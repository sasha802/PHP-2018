<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>

    <?php
        require_once('headerTemplate.html');
        require_once('appVariables.php');
        require_once('dbsConnectionVariables.php');
        require_once('sessionStarter.php');

        $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to MySQL Server.');

        $userId  = $_SESSION['userId'];

        $sqlFirstName = '';
        $sqlLastName = '';
        $sqlGender = '';
        $sqlBirthdate = '';
        $sqlWeight = '';

        $sqlImage = "SELECT *
                     FROM exercise_user
                     WHERE ID = '$userId'";

        $sqlResults = mysqli_query($dbs, $sqlImage);

        foreach ( $sqlResults as $row ) {

            $sqlFirstName = $row['first_name'];
            $sqlLastName = $row['last_name'];
            $sqlGender = $row['gender'];
            $sqlBirthdate = $row['birthdate'];
            $sqlWeight = $row['weight'];
        }


        echo '<div class="mainContainer">';
            echo '<div class="container">';
                foreach ( $sqlResults as $row ) {
                    echo '<p><img src="' . SC_UPLOADPATH . $row['image_name'] . '" alt="User Profile Image"></p>';
                }
            echo '</div>';
        echo '</div>';



        if ( isset($_POST['submit']) ) {


            $userFirstName = mysqli_real_escape_string($dbs, trim($_POST['firstName']));
            $userLastName = mysqli_real_escape_string($dbs, trim($_POST['lastName']));
            $userGender = mysqli_real_escape_string($dbs, $_POST['gender']);
            $userBirthdate = $_POST['birthdate'];
            $userWeight = mysqli_real_escape_string($dbs, $_POST['weight']);


            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageTmpLocation = $_FILES['image']['tmp_name'];


            if ( !empty($userFirstName) && !empty($userLastName) && !empty($userGender) && !empty($userBirthdate) && !empty($userWeight) && is_numeric($userWeight) ) {


                $sql = "UPDATE exercise_user 
                        SET first_name = '$userFirstName', last_name = '$userLastName', gender = '$userGender',
                                    birthdate = '$userBirthdate', weight = '$userWeight'
                        WHERE ID = '$userId'";

                mysqli_query($dbs, $sql)
                or die('Error inserting into ' . DB_NAME . ' database');


                if ( (($imageType == 'image/gif') || ($imageType == 'image/jpeg') || ($imageType == 'image/pjpeg')
                    || ($imageType == 'image/png') && ($imageSize > 0) && ($imageSize <= SC_MAXFILESIZE)) ) {

                    if ( $imageError == 0 ) {

                        $targetImgLocation = SC_UPLOADPATH . $imageName;

                        if ( move_uploaded_file($imageTmpLocation, $targetImgLocation) ) {

                            $sql = "UPDATE exercise_user 
                                SET image_name = '$imageName'
                                WHERE ID = '$userId'";

                            mysqli_query($dbs, $sql)
                            or die('Error inserting into ' . DB_NAME . ' database');

                        } else {
                            echo '<p class="mainContainer">Error moving image file</p>';
                        }

                    } else {
                        echo '<p class="mainContainer">Error uploading an image.</p>';
                    }
                }

            } else {
                echo '<p class="mainContainer">Please fill in the form (weight has to be a number.)</p>';
            }

        }

    mysqli_close($dbs);
    ?>

    <div class="container">
        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" >

            <div class="form-group">
                <label class="ontrol-label">First Name:</label>
                <input class="form-control" type="text" name="firstName" value="
                    <?php

                        if ( isset($_POST['submit']) ) {
                            echo $userFirstName;

                        } else {
                            echo $sqlFirstName;
                        }
                ?>" />
            </div>

            <div class="form-group">
                <label class="ontrol-label">Last Name:</label>
                <input class="form-control" type="text" name="lastName" value="
                    <?php
                        if ( isset($_POST['submit']) ) {
                            echo $userLastName;
                        } else {
                            echo $sqlLastName;
                        }
                    ?>
                "/>
            </div>

            <div class="form-group">
                <label class="ontrol-label">Select Yor Gender:</label>
                <select class="form-control" name="gender">
                    <option value="" <?php if( isset($_POST['submit']) && $userGender === '' ) echo 'selected' ?>>-- Select --</option>
                    <option value="F" <?php if( $sqlGender === 'F' ) echo 'selected' ?>>F</option>
                    <option value="M" <?php if( $sqlGender === 'M' ) echo 'selected'?>>M</option>
                </select>
            </div>

            <div class="form-group">
                <label class="ontrol-label">Birthdate (YYYY-mm-dd):</label>
                <input class="form-control datePicker" type="text" name="birthdate" value="
                    <?php
                        if ( isset($_POST['submit']) ) {
                            echo $userBirthdate;
                        } else {
                            echo $sqlBirthdate;
                        }
                ?>"/>
            </div>

            <div class="form-group">
                <label class="ontrol-label">Weight:</label>
                <input class="form-control" type="text" name="weight" value="
                    <?php
                        if ( isset($_POST['submit']) ) {
                            echo $userWeight;
                        } else {
                            echo $sqlWeight;
                        }
                ?>"/>
            </div>

            <input type="hidden" name="MAX_FILE_SIZE" /><br />
            <label for="image">Profile Image (allowed extensions .gif, .jpeg, .pjpeg, .png):</label>
            <input type="file" id="image" name="image" />
            <hr />

            <button class="btn btn-success" type="submit" name="submit">Edit Profile</button>

        </form>
    </div>

</body>
</html>


