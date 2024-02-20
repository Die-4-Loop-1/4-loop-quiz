
<?php

       //Session starten
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "./includes/collector.php";
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
$totalPoints = 0;
$points = 0;

for ($i=0; $i < count($_SESSION['quiz']['questionIds']); $i++) {
        foreach ($_SESSION['userAnswers'][$i] as $answer) {

            if (in_array($answer, $_SESSION['quiz']['correctIds'][$i])) {
                $points +=1;
                }
                    
        }
        $totalPoints += count($_SESSION['quiz']['correctIds'][$i]);

    }
    
?>

<?php 
$prozentErgebnis = $points * 100 / $totalPoints;

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
    $gif = "gifs/good-job-unscreen.gif";
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


        <p>Sie haben <?php echo $points; ?> von <?php echo $totalPoints; ?> möglichen Punkten erreicht.</p>
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