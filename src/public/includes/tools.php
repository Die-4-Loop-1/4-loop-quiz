<?php

function prettyPrint($value, $label) {
    if ($label) print "<pre>$label";
    else print "<pre>";

    print_r($value); 
    print "</pre>";
}

function prettyERPrint($stuff) {
    echo ('<pre>');
    print_r($stuff);
    echo ('</pre>');
}




// function generateQuiz($topic, $count, $dbConn) {
//     $query = $dbConn->prepare("SELECT question-id FROM question WHERE topic = '$topic' ORDER BY RAND() LIMIT $count");
//     $query->execute();
//     $questionIds = $query->fetchAll(PDO::FETCH_COLUMN);
//     // prettyPrint($questionIds);
// }
// $questionIds = generateQuiz($_POST['topic'], $_POST['questionNum'], $dbConn);
?>

