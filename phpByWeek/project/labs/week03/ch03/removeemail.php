<img src="images/blankface.jpg" width="161" height="350" alt="" style="float:right" />
<img name="elvislogo" src="images/elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
<p>Enter an email address to remove.</p>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

<?php

    $dbs = mysqli_connect('localhost', 'root', '', 'elvis_store')
        or die('Error connection to the database.');

    if ( isset($_POST['submit']) ) {

        foreach ( $_POST['todelete'] as $itemDelete ) {

            $query = "DELETE FROM email_list
              WHERE id = $itemDelete";

            mysqli_query($dbs, $query)
            or die('Error executing query.');
        }

    }


    $query = "SELECT * from email_list";
    $result = mysqli_query($dbs, $query);


    while ( $row = mysqli_fetch_array($result) ) { ?>

        <input type="checkbox" value="<?php echo $row['id']; ?>" name="todelete[]" />

        <?php
            echo $row['first_name'];
            echo ' ' . $row['last_name'];
            echo ' ' . $row['email'] . '<br />';
        ?>

    <?php }

    mysqli_close($dbs);

    ?>

    <input type="submit" name="submit" value="Remove" />
    </form>
