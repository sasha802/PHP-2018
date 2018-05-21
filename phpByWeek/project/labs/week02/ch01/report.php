<html>

    <head>
        <title>Aliens Abducted Me - Report an Abduction</title>
    </head>
    <body>
        <h2>Aliens Abducted Me - Report an Abduction</h2>

        <?php

            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $whenItHappened = $_POST['whenithappened'];
            $howLong = $_POST['howlong'];
            $howMany = $_POST['howmany'];
            $alienDescription = $_POST['aliendescription'];
            $whatTheyDid = $_POST['whattheydid'];
            $fangSpotted = $_POST['fangspotted'];
            $email = $_POST['email'];
            $other = $_POST['other'];


            $dbc = mysqli_connect('localhost', 'root', '', 'aliendatabase')
                or die('Error connecting to MySQL server.');

            $query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, how_long, how_many, " .
                "alien_description, what_they_did, fang_spotted, other, email) " .
                "VALUES ('$firstName', '$lastName', '$whenItHappened', '$howLong', '$howMany', '$alienDescription', " .
                 "'$whatTheyDid', '$fangSpotted', '$email', '$other')";

            $result = mysqli_query($dbc, $query)
                or die('Error querying database.');

            mysqli_close($dbc);
            

            echo 'Thanks for submitting the form.<br />';
            echo 'You were abducted ' . $whenItHappened;
            echo ' and were gone for ' . $howLong . '<br />';
            echo 'Number of aliens: ' . $howMany . '<br />';
            echo 'Describe them: ' . $alienDescription . '<br />';
            echo 'The aliens did this ' . $whatTheyDid . '<br />';
            echo 'Was Fang there? ' . $fangSpotted . '<br />';
            echo 'Other comments ' . $other . '<br />';
            echo 'Your email address is ' . $email;


        ?>

    </body>
</html>