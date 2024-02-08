<?php
session_start();


// Hilfsmitttel
include 'tools.php'; // prettyprint() laden
include 'db.php'; // Datenbank-Verbindung $dbConnection aufbauen

// prettyPrint($_SESSION, '$_SESSION');
// prettyPrint($_POST, '$_POST');

// Falls verfügbar, hole die Quiz-Daten aus der Session.
if (isset($_SESSION["quiz"])) $quiz = $_SESSION["quiz"];
else $quiz = null;


/*
Hole die Indexnummer der Letzten Frage aus dem $_Post "lastQuestionIndex"
lastQuestionIndex wird für quest.php und auswertung.php verwendet, 
jedoch nicht fur index.php.*/

if (isset($_POST["lastQuestionIndex"])) {
    $lastQuestionIndex = intval($_POST["lastQuestionIndex"]);

if ($lastQuestionIndex >= 0) {
    $questionName = "question-" . $lastQuestionIndex;
    $_SESSION[$questionName] = $_POST;
}

}
else {
    $lastQuestionIndex = -1;
}

// Abhängig von der aktuellen Hauptseite: Bereite die benötigten Seitendaten vor.
$scriptName = $_SERVER['SCRIPT_NAME']; // https://www.php.net/manual/en/reserved.variables.server.php

// index.php (Startseite)----------------------------------------------------------------------------------
if (str_contains($scriptName, 'index')) {
    session_unset();
    $quiz = null;
}

// quest.php (Frageseite)----------------------------------------------------------------------------------
else if (str_contains($scriptName, 'quest')) {
    // echo "QUEST ----------------------------------------";
    // prettyPrint($quiz, "QUIZ DATA?!");

    // quiz-Daten vorbereiten 
    if ($quiz === null) { // falls noch keine $quiz Daten verfügbar sind....
        // Starte ein neues Quiz....
        $questionNum = intval($_POST["questionNum"]);
    
        // hole die Sequenz der Fragen 'id' -s aus der Datenbank.
        $questionIdSequence = fetchQuestionIdSequence($_POST["topic"], $questionNum, $dbConnection);
        
        // Berechne die wirklich mögliche Anzahl von Fragen.
        $questionNum = count($questionIdSequence);
    
        // Sammle Quiz-daten in $Quiz und Speicher $quiz in der Session.
        $quiz = array(
            "topic" => $_POST["topic"],
            "questionNum" => $questionNum,
            "lastQuestionIndex" => $lastQuestionIndex,
            "currentQuestionIndex" => -1,
            "questionIdSequence" => $questionIdSequence
        );
    
        $_SESSION["quiz"] = $quiz;
    }

        // // DEVONLY
        // prettyPrint($_SESSION["quiz"], "\$quiz is");

        // Index der aktuellem Frage, sowie für das Quiz setzen
        $currentQuestionIndex = $lastQuestionIndex + 1;

        if ($currentQuestionIndex >= $quiz["questionNum"] - 1) {
            // Auf die auswertung.php Seite Springen.
            $actionUrl = "auswertung.php";
        }
        else{
            // die nächste Frage darstellen
            $actionUrl = "quest.php";
        }
        
    }






//auswertung.php--------------------------------------------------------------------------------------------
else if (str_contains($scriptName, 'auswertung')){
    // $currentQuestionIndex = -1;
}






