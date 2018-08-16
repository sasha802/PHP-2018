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

        $sqlImage = "SELECT image_name 
                     FROM exercise_user
                     WHERE ID = '$userId'";

        $sqlResults = mysqli_query($dbs, $sqlImage);


        echo '<div>';
            foreach ( $sqlResults as $row ) {
                echo '<p><img src="' . SC_UPLOADPATH . $row['image_name'] . '" alt="User Profile Image"></p>';
            }
        echo '</div>';


        if ( isset($_POST['submit']) ) {

            $userFirstName = mysqli_real_escape_string($dbs, trim($_POST['firstName']));
            $userLastName = mysqli_real_escape_string($dbs, trim($_POST['lastName']));
            $userGender = mysqli_real_escape_string($dbs, $_POST['gender']);
            $userBirthdate = mysqli_real_escape_string($dbs, $_POST['birthdate']);
            $userWeight = mysqli_real_escape_string($dbs, $_POST['weight']);

            $imageName = $_FILES['image']['name'];
            $imageType = $_FILES['image']['type'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageTmpLocation = $_FILES['image']['tmp_name'];


            if ( (($imageType == 'image/gif') || ($imageType == 'image/jpeg') || ($imageType == 'image/pjpeg')
                || ($imageType == 'image/png') && ($imageSize > 0) && ($imageSize <= SC_MAXFILESIZE)) ) {

                if ( $imageError == 0 ) {

                    $targetImgLocation = SC_UPLOADPATH . $imageName;

                    if ( move_uploaded_file($imageTmpLocation, $targetImgLocation) ) {


                        $sql = "UPDATE exercise_user 
                                SET first_name = '$userFirstName', last_name = '$userLastName', gender = '$userGender',
                                    birthdate = '$userBirthdate', weight = '$userWeight', image_name = '$imageName'
                                WHERE ID = '$userId'";

                        mysqli_query($dbs, $sql)
                            or die('Error inserting into ' . DB_NAME . ' database');

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
                <option value="" <?php if( isset($_POST['submit']) && $userGender === '' ) echo 'selected' ?>>-- Select --</option>
                <option value="F" <?php if( isset($_POST['submit']) && $userGender === 'F' ) echo 'selected' ?>>F</option>
                <option value="M" <?php if( isset($_POST['submit']) && $userGender === 'M' ) echo 'selected'?>>M</option>
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

</body>
</html>


