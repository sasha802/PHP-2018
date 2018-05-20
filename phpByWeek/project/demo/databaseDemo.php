<html>
    <head>
        <title>Full Name</title>
    </head>
    <body>
        <h2>Full Name</h2>

    <?php

        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];

        $dbc = mysqli_connect('localhost', 'root', '', 'opnomarova1')
            or die('Error connecting to MySQL server.');

        $query = "INSERT INTO fullname (first_name, last_name) " .
            "VALUES ('$first_name', '$last_name')";

        $result = mysqli_query($dbc, $query)
            or die('Error querying database.');

        mysqli_close($dbc);

        echo "Hi " . $first_name . " " . $last_name . " . Thank you for submitting the form";
    ?>
    </body>
</html>