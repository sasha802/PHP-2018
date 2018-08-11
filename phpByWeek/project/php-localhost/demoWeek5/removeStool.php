<?php
 require_once('dbsConnectionVariables.php');

 $id = $_GET['id'];
 $date = $_GET['date'];
 $description = $_GET['description'];
 $image = $_GET['image'];

 $dbs = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
 or die('Error connecting to the database ' . DB_NAME);

 $query = 'DELETE FROM stoolCollection
           WHERE id = ' . $id;
 $results = mysqli_query($dbs, $query)
 or die ('Error removing item for stoolCollection table.');

 if ( $results ) {
     echo 'Item was removed with id ' . $id;
     echo '<a href="admin.php">Go back to the admin page</a>';
 }





