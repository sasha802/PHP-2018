<?php
     require_once('authorize.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
    <body>
    <h2>Stool Collection - Remove a Stool</h2>
    <hr />
    <?php
         require_once('dbsConnectionVariables.php');
         require_once('appVariables.php');

        if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['description']) && isset($_GET['image'])) {

            $id = $_GET['id'];
            $date = $_GET['date'];
            $description = $_GET['description'];
            $image = $_GET['image'];

        } else if (isset($_POST['id']) && isset($_POST['description'])) {

            $id = $_POST['id'];
            $description = $_POST['description'];

        } else {
            echo '<p class="error">Sorry, no stool was specified for removal.</p>';
        }

        if ( isset($_POST['submit']) ) {

            if ( $_POST['confirm'] == 'Yes' ) {

                $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to the database ' . DB_NAME);

                $query = "SELECT image 
                          FROM stoolCollection
                          WHERE id = $id
                          LIMIT 1";

                $queryImageData = mysqli_query($dbs, $query)
                    or die('Error selection stool');

                $row = mysqli_fetch_array($queryImageData);
                    @unlink(SC_UPLOADPATH . $row['image']);


                $query = "DELETE FROM stoolCollection
                          WHERE id = $id
                          LIMIT 1";
                mysqli_query($dbs, $query)
                    or die ('Error removing item for stoolCollection table.');

                mysqli_close($dbs);

                echo '<p>The stool with description ' . $description . ' was successfully removed.';

            } else {
                echo '<p>The stool was not removed.</p>';

            }
        } else if ( isset($id) && isset($description) && isset($date) ) {

            echo '<p>Are you sure you want to delete the following stool?</p>';
            echo '<p><strong>Description: </strong>' . $description;
            echo '<strong>Date </strong>' . $date . '</p>';

            echo '<form method="post" action="removeStool.php">';
            echo '<input type="radio" name="confirm" value="Yes" />Yes';
            echo '<input type="radio" name="confirm" value="No" />No';
            echo '<input type="submit" name="submit" value="submit" />';
            echo '<input type="hidden" name="id" value="' . $id . '" />';
            echo '<input type="hidden" name="description" value="' . $description . '" />';
            echo '</form>';

        }

        echo '<p><a href="admin.php"><< Back to admin page</a></p>';

    ?>
    </body>
</html>




