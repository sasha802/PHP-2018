<?php

    $userFirstName = $_POST['firstName'];
    $userLastName = $_POST['lastName'];
    $userGender = $_POST['gender'];
    $userBirthdate = $_POST['birthdate'];
    $userWeight = $_POST['weight'];
    $userPassword = $_POST['password'];

    $dbs = mysqli_connect('localhost', 'root', '', 'exercise_logger')
        or die('Error connecting to MySQL Server.');

    $query = "INSERT INTO exercise_user (first_name, last_name, gender, birthdate, weight, password)
              VALUES ('$userFirstName', '$userLastName', '$userGender', '$userBirthdate', '$userWeight', '$userPassword')";

    mysqli_query($dbs, $query)
        or die('Error querying database');

    mysqli_close($dbs);
?>

<h1>Thank you</h1>


