<?php
namespace project\project01;

    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesheet/style.css\"/>";

    $noun = $_POST['noun'];
    $verb = $_POST['verb'];
    $adjective = $_POST['adjective'];
    $adverb = $_POST['adverb'];
    //$storyOutput = $_POST['storyOutput'];

    $story = "Do you $verb your $adjective $noun $adverb";


    $dbs = mysqli_connect('localhost', 'root', '', 'madlibs')
        or die ('Error connecting to MySQL server.');


    $query = "INSERT INTO madlibs_story(noun, verb, adjective, adverb, completed_story)
              VALUES ('$noun', '$verb', '$adjective', '$adverb', '$story')";

    mysqli_query($dbs, $query)
        or die('Error querying database.');



    $sql = "SELECT completed_story
            FROM madlibs_story
            ORDER BY created DESC ";

    $result = $dbs->query($sql);


    if ( $result->num_rows > 0 ) {

        echo '<div class="content">';
        echo '<h1>Thank you for playing</h1>';
        echo "You entered noun: $noun <br />";
        echo "You entered verb: $verb <br />";
        echo "You entered adjective: $adjective <br />";
        echo "You entered adverbs: $adverb <br />";

        echo '<div id="tableContainer">';
        echo '<table id="storyTable"><tr><th>Story</th></tr>';

        while ( $row = $result->fetch_assoc() ) {
            echo '<tr><td>' . $row['completed_story'] . '</td></tr>';
        }

        echo '</table>';
        echo '</div>';
        echo '</div>';

    } else {

        echo 'No results of the story.';
    }


    mysqli_close($dbs);