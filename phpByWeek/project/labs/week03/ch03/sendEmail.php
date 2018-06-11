<?php
    $subject = '';
    $elvisEmail = '';

    if ( isset($_POST['submit']) ) {

        $from = 'elmer@makemeelvis.com';
        $subject = $_POST['subject'];
        $elvisEmail = $_POST['elvisMail'];
        $outputForm = false;

        if ( empty($subject) && empty($elvisEmail) ) {

            echo 'Please enter subject and body of the email.<br /><br />';
            $outputForm = true;

        }

        if ( empty($subject) && !empty($elvisEmail) ) {

            echo 'Please enter subject of the email.<br /><br />';
            $outputForm = true;

        }

        if ( !empty($subject)  && empty($elvisEmail) ) {

            echo 'Please enter body of the email.<br /><br />';
            $outputForm = true;

        }

        if ( !empty($subject) && !(empty($elvisEmail)) ) {


            $dbs = mysqli_connect('localhost', 'root', '', 'elvis_store')
            or die('Error connecting to the database.');

            $query = "SELECT * 
                FROM email_list";

            $queryResult = mysqli_query($dbs, $query)
            or die('Error running query.');


            foreach ( $queryResult as $result ) {
                echo $result['first_name'] . ' ' . $result['last_name'] . ': ' . $result['email'] . '<br />';
            }


            mysqli_close($dbs);

        }

    } else {

        $outputForm = true;
    }

    if ( $outputForm ) { ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Make Me Elvis - Add Email</title>
            <link rel="stylesheet" type="text/css" href="style.css" />
        </head>
        <body>
        <img src="images/blankface.jpg" width="161" height="350" alt="" style="float:right" />
        <img name="elvislogo" src="images/elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
        <p><strong>Private:</strong> For Elmer's use ONLY<br />
            Write and send an email to mailing list members.</p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="subject">Subject of email:</label>
            <input type="text" name="subject" value="<?php echo $subject ?>"/><br />
            <label for="elvismail">Body of email:</label>
            <textarea id="elvismail" name="elvisMail" rows="8" cols="40"><?php echo $elvisEmail ?></textarea><br /><br />
            <input type="submit" name="submit" value="Send Email" />
        </form>
        </body>
        </html>

    <?php } ?>




