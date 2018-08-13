<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Stool Page</title>
</head>
    <body>
        <h2>Stool Collection - Add Your Stool</h2>

        <?php
            require_once('appVariables.php');
            require_once('dbsConnectionVariables.php');

            if ( isset($_POST['submit']) ) {

                $description = $_POST['description'];
                $image = $_FILES['image']['name'];
                $imageType = $_FILES['image']['type'];
                $imageSize = $_FILES['image']['size'];
                $imageError = $_FILES['image']['error'];
                $imageTempLocation = $_FILES['image']['tmp_name'];

                if ( !empty($description) && !empty($image) ) {

                    if ( (($imageType == 'image/gif') || ($imageType == 'image/jpeg') || ($imageType == 'image/pjpeg')
                        || ($imageType == 'image/png') && ($imageSize > 0) && ($imageSize <= SC_MAXFILESIZE)) ) {

                        if ( $imageError == 0 ) {

                            $target = SC_UPLOADPATH . $image;

                            if ( move_uploaded_file($imageTempLocation , $target) ) {

                                $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                                    or die('Error connection to the database');

                                $sql = "insert into stoolCollection 
                                        values(0, NOW(), '$description', '$image');";

                                $results = mysqli_query($dbs, $sql)
                                    or die('Error inserting image.');

                                echo '<p>Thank you for inserting an image</p>';
                                echo '<p>Description: ' . $description . '</p>';
                                echo '<p><img src=" ' . SC_UPLOADPATH . $image . ' " alt="Stool Image"></p>';
                                echo '<p><a href="week5Index.php">Back to list of stools</a></p>';

                                $description = '';
                                $image = '';
                                mysqli_close($dbs);


                            } else {
                                echo 'Error uploading image';
                            }
                        }

                    } else {

                        echo 'Not correct image extension';
                    }

                    // Try to delete the temporary image
                    //@unlink($_FILES['image']['tmp_name']);
                    if ( file_exists($imageTempLocation) ) {
                        unlink($imageTempLocation);
                    }
                } else {

                    echo 'Please enter all of the information to add your stool.';
                }
            }
        ?>

        <hr />
        <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo SC_MAXFILESIZE ?>" />
            <label for="name">Description:</label>
            <input type="text" id="description" name="description" value="
                <?php
                    if ( !empty($description) ) {

                        echo $description;
                    }
                ?>
            "/><br />
            <label for="image">Stool Image:</label>
            <input type="file" id="image" name="image" />
            <hr />
            <input type="submit" value="Add" name="submit" />
        </form>
    </body>
</html>
