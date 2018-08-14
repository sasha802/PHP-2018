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
        <h2>Stool Collection - Stool Administration</h2>
        <p>Below is a list of all Stools in the collection. Use this page to remove Stools as needed.</p>
        <hr />
        <?php
            require_once('appVariables.php');
            require_once('dbsConnectionVariables.php');

            // Connect to the database.
            $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connection to the database ' . DB_NAME);

            // Retrieve the stool data from MySQL
            $query = 'SELECT * 
                      FROM stoolCollection
                      ORDER BY date DESC ';

            $queryData = mysqli_query($dbs, $query)
                or die('Error getting data form ' . DB_NAME);


        echo '<table style="border: 1px solid cornflowerblue">';

        foreach ( $queryData as $row ) {

            echo '<tr>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td><a href="removeStool.php?id=' . $row['id'] . '&date=' . $row['date'] .
                '&description=' . $row['description']  . '&image=' . $row['image'] . '">Remove</a></td>';
            echo '</tr>';
        }

        mysqli_close($dbs);

        ?>
    </body>
</html>


