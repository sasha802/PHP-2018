<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guitar Wars - Add Your High Score</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Guitar Wars - Add Your High Score</h2>

<?php

//define('GW_UPLOADPATH', 'images/');

if ( isset($_POST['submit']) ) {

    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_FILES['screenshot']['name'];
    $screenshotType = $_FILES['screenshot']['type'];
    $screenshotSize = $_FILES['screenshot']['size'];


    if ( !empty($name) && !empty($score) && !empty($screenshot)) {

       // $target = GW_UPLOADPATH . $screenshot;

        if ( move_uploaded_file($_FILES['screenshot']['tmp_name'], $target) ) {

            $dbs = mysqli_connect('localhost', 'root', '', 'guitar_wars');


            $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
            mysqli_query($dbs, $query);

            echo '<p>Thank you for adding your new high score!</p>';
            echo '<p><strong>Name: </strong>' . $name . '<br />';
            echo '<strong>Score: </strong>' . $score . '</p>';
            echo '<img src="' . GW_UPLOADPATH . $screenshot .'" alt="score image"/>';
            echo '<p><a href="index.php">&lt;&lt; Back to the high scores</a></p>';

            $name = '';
            $score = '';
            $screenshot = '';

            mysqli_close($dbs);

        } else {
            echo '<p class="error">Sorry, there was a problem uploading file.';
        }

    } else {

        echo '<p class="error">Please enter all of the information to add your high score</p>';
    }
}

?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768" />

    <label for="name">Name:</label>
    <input type="text" name="name" id="name"
           value="<?php

           if ( !empty($name) ) {

               echo $name;

           } ?>" />
    <br />
    <label for="score">Score:</label>
    <input type="text" name="score" id="score"
           value="<?php

           if ( !empty($score) ) {

               echo $score;

           } ?>" /><br /><br />
    <label for="screenshot">Screen Shot</label>
    <input type="file" id="screenshot" name="screenshot"/>
    <hr />
    <input type="submit" name="submit" value="Add Score" />

</form>
</body>
</html>