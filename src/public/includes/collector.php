<?php
include 'db.php';
// include 'collector.php';
include 'fools.php';

// Setup & answers
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['topic'])) {
        $quiz = generateQuiz($_POST["topic"], $_POST["questionNum"], $dbConn);
        $_SESSION['quiz'] = $quiz;
    } elseif (empty($_POST)) {
        // Wenn der Submit leer ist, füge einen leeren Eintrag zum userAnswers-Array hinzu
        $_SESSION['userAnswers'][] = [0];
    } else {
        // Andernfalls, wenn Antworten vorhanden sind, füge sie zum userAnswers-Array hinzu TEST
        $_SESSION['userAnswers'][] = $_POST['answers'];
    }
};

?>