<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stool Demo</title>
</head>
<body>
    <h2>Stool Collection</h2>
    <p>Welcome to My Stool Collection. If you have a stool to share, feel free to <a href="addstool.php">add one</a>.</p>
    <hr />
    <?php

        require_once('dbsConnectionVariables.php');
        require_once('appVariables.php');

        $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to the database ' . DB_NAME);

        $query = 'SELECT * 
                  FROM stoolCollection
                  ORDER BY date DESC ';
        $queryResults = mysqli_query($dbs, $query)
        or die('Error querying data from ' . DB_NAME);



        echo '<table>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Description</th>';
        echo '<th>Image</th>';
        echo '</tr>';

        foreach ( $queryResults as $row ) {
            var_dump($row['image']);
            echo '<tr>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';

            if ( is_file(SC_UPLOADPATH . $row['image']) && filesize(SC_UPLOADPATH . $row['image']) > 0 ) {

                echo '<td><img src="' . SC_UPLOADPATH . $row['image'] . '"></td>';

            } else {

                echo '<td><img src="' . SC_UPLOADPATH . 'genericStool.png' . '"></td>';
            }

            echo '</tr>';
        }

        echo '</table>';


        mysqli_close($dbs);



    ?>

</body>
</html>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    img {
        width: 10%
    }
</style>