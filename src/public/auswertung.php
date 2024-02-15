<?php
//Session starten
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include "./includes/collector.php";
    
    

// get message coresponding to % of correct answers
function getMessage($points, $totalPoints) {
    $messages = [
        "My disappointment is immeasurable and my day is ruined. ",
        "Bad performance. Let's work on it.",
        "Oh no, that didn't go well. Keep practicing.",
        "Hmm, you might want to try again.",
        "Not bad, but there's room for improvement.",
        "Good effort! You're doing well.",
        "Great work! Keep it up.",
        "Amazing job! You did exceptionally well.",
        "Incredible! You're on fire!",
        "God-like performance! You are absolutely phenomenal!",
        "It’s over 9000!",
    ];
    $messageIndexPrecentage = ($points / $totalPoints) *10;
    $messageIndex = intval($messageIndexPrecentage);
    return $messages[$messageIndex];
}


    $points = 0;
    $totalPoints = 0;

    for ($i=0; $i < count($_SESSION['quiz']['questionIds']); $i++) {
        foreach ($_SESSION['userAnswers'][$i] as $answer) {
            prettyPrint($answer);
            prettyPrint($_SESSION['quiz']['correctIds'][$i]);
            if (in_array($answer, $_SESSION['quiz']['correctIds'][$i])) {
                $points +=1;
                }
            $totalPoints += count($_SESSION['quiz']['correctIds'][$i]);
        }
    }
$message = getMessage($points, $totalPoints);
    // foreach ($_SESSION as $questionKey =>  $data) {
    //     if (str_contains($questionKey, 'question-')){
    //         if ($data["multipleChoice"] === 'true') {
    //             // Multi Choice: Radio Button
    //             foreach ($data as $kay => $value) {
    //                 if (str_contains($kay, 'answer_')){
    //                 $points = intval ($value);
    //                 $totalPoints = $totalPoints + $points; 
    //                 }
    //             }
    //         }
    //         else if ($data["multipleChoice"] === 'false'){
    //             //singel Choice: radio button
                
    //             // Falls keine Antwort gewählt wurde fehlt "single-choice" im $_POST.
    //             if (isset($data["single-choice"])){
    //                 $points = intval ($data["single-choice"]);
    //                 $totalPoints = $totalPoints + $points;
    //             }
    //         }
    //         $maxTotalPoints = $maxTotalPoints + intval($data["maxPoints"]);
    //     }
    // }
        
?>
<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auswertung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="./assets//css//talhaStyles.css">
    <script src="assets/js/main.js"></script>

</head>
<body>

<?php 
    /*
    Betimme die Anzahl der ereichten Punkte. Dazu wird das 'value' -Attribut der Eingabefelder ausgewertet.
    
    Wichtig: Sämtliche $_SESSION-werte müssen fertig gesetzt sein. bevor die Punktzahlen gesammelt werden dürfen.*/

    $totalPoints = 0;
    $maxTotalPoints = 1;

    foreach ($_SESSION as $questionKey =>  $data) {
        if (str_contains($questionKey, 'question-')){
            if ($data["multipleChoice"] === 'true') {
                // Multi Choice: Radio Button
                foreach ($data as $kay => $value) {
                    if (str_contains($kay, 'answer_')){
                    $points = intval ($value);
                    $totalPoints = $totalPoints + $points; 
                    }
                }
            }
            else if ($data["multipleChoice"] === 'false'){
                //singel Choice: radio button
                
                // Falls keine Antwort gewählt wurde fehlt "single-choice" im $_POST.
                if (isset($data["single-choice"])){
                    $points = intval ($data["single-choice"]);
                    $totalPoints = $totalPoints + $points;
                }
            }
            $maxTotalPoints = $maxTotalPoints + (intval($data["maxPoints"]));
        }
    }
        
?>
<?php 
$prozentErgebnis = ($totalPoints * 100 / $maxTotalPoints)  ; 

$resultText = ''; 
$gif = '';

if ($prozentErgebnis > 70) {
    $resultText = "Herzlichen Glückwunsch"; 
    $audioFile = "audio/good_job.mp3";
    $message = "Gut gemacht, weiter so.";
    $gif = "gifs/exelent_job.gif";
} elseif ($prozentErgebnis >= 40 && $prozentErgebnis <= 70) {
    $resultText = "Gut gemacht";
    $audioFile = "audio/could_better.mp3";
    $message = "Sie können es noch besser.";
    $gif = "gifs/good_job.gif";
} else {
    $resultText = "Gib nicht auf!";
    $audioFile = "audio/try_harder.mp3";
    $message = "Klicken Sie doch nicht einfach durch.";
    $gif = "gifs/bad_job.gif";
}
    ?>
    <div class="background-a">
        <div class="last-container">
        <div class="a-logo-box">
            <img class="logo-q" src="/img/logo-quiz.png" alt="">
        </div>

     
</div>
    <div class="result-page-box">
        <p class="result-text">
            <?php echo $resultText; ?></p>

            <div class="gif-container">
                <img src="<?php echo $gif; ?>" alt="">
            </div>


        <p>Sie haben <?php echo $totalPoints; ?> von <?php echo $maxTotalPoints; ?> möglichen Punkten erreicht.</p>
<div class="auswertung-bnt">
                    <a href="index.php">
                        <button type="button" class="btn btn-success">Neues Quiz</button>
                    </a>
                </div> 
    </div>

    
    <!-- Add the audio element here without controls -->
    <audio autoplay>
        <source src="<?php echo $audioFile; ?>" type="audio/mp3">
    </audio>
</div>
                             
               
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>