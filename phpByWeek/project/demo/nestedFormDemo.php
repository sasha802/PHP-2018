<?php
    echo '<h1>Thank you for submitting the form.</h1>';

    $fruitsForm = $_POST['apples'];
    $submittedForm = $_POST['submit'];

    if ( isset($submittedForm) ) {

        foreach ($fruitsForm as $key => $value) {

            if ($value == 'select') {
                echo 'select your apple';
                exit;

            } else {

                echo "You selected ", $value, " apple";
            }

        }
    }
