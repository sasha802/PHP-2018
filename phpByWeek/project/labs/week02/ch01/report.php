<html>

<head>
    <title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>
    <h2>Aliens Abducted Me - Report an Abduction</h2>

    <?php

        $whenItHappened = $_POST['whenithappened'];
        $howLong = $_POST['howlong'];
        $alienDescription = $_POST['aliendescription'];
        $fangSpotted = $_POST['fangspotted'];
        $email = $_POST['email'];

        echo 'Thanks for submitting the form.<br />';
        echo 'You were abducted ' . $whenItHappened;
        echo ' and were gone for ' . $howLong . '<br />';
        echo 'Describe them: ' . $alienDescription . '<br />';
        echo 'Was Fang there? ' . $fangSpotted . '<br />';
        echo 'Your email address is ' . $email;
    ?>

</body>
</html>