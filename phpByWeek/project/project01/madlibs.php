<?php
namespace project\project01;

    $noun = $_POST['noun'];
    $verb = $_POST['verb'];
    $adjective = $_POST['adjective'];
    $adverb = $_POST['adverb'];
    //$storyOutput = $_POST['storyOutput'];

    $story = "Hello user! Do you $verb your $adjective $noun $adverb";


    $dbs = mysqli_connect('localhost', 'root', '', 'madlibs')
        or die ('Error connecting to MySQL server.');


    $query = "INSERT INTO madlibs_story(noun, verb, adjective, adverb, completed_story)
              VALUES ('$noun', '$verb', '$adjective', '$adverb', '$story')";

    mysqli_query($dbs, $query)
        or die('Error querying database.');


    echo "You entered noun: $noun <br />";
    echo "You entered verb: $verb <br />";
    echo "You entered adjective: $adjective <br />";
    echo "You entered adverbs: $adverb <br />";


    $sql = "SELECT completed_story
            FROM madlibs_story";

    $result = $dbs->query($sql);


    if ( $result->num_rows > 0 ) {

        while ( $row = $result->fetch_assoc() ) {
            echo $row['completed_story'] . '<br />';
        }

    } else {

        echo 'No results of the story.';
    }





    //echo "$story";

    mysqli_close($dbs);