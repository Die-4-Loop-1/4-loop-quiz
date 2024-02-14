<?php
include 'db.php';
// include 'collector.php';
include 'fools.php';

// Setup & answers
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['topic'])) {
        $quiz = generateQuiz($_POST["topic"],$_POST["questionNum"], $dbConn);
        $_SESSION['quiz'] = $quiz;
    }
    elseif (empty($_POST)) {
        // $questionCounter--;
        // $_SESSION['questionCounter']--;
    }
    else{
        $_SESSION['userAnswers'][] = $_POST['answers'];
       prettyPrint($_SESSION['userAnswers'], 'test');

    }
};
 
?>