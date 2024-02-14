<?php
   //Session starten
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   
   
    // get $questioncounter from SESSION. returns as 0 if not set
    if (isset($_SESSION['questionCounter'])) {
    $_SESSION['questionCounter']++;
    $questionCounter = $_SESSION['questionCounter'];
    } else {
    $questionCounter = 0;
    $_SESSION['questionCounter'] = $questionCounter;
    }
    include "./includes/collector.php";

    $quiz = $_SESSION['quiz'];
    $questionId = $quiz['questionIds'][$questionCounter];
    $question = getQuestion($questionId, $dbConn);
    $answers = getAnswers($_SESSION['quiz']['answerIds'][$questionCounter], $dbConn);
// prettyPrint($quiz,'test');
    $type = 'radio';
    if (count($quiz['correctIds'][$questionCounter])>1) {
        //Multiple-Choice
        $type='checkbox';
    } 

    if ($questionCounter +1  >= count( $quiz['questionIds'])) {
        $nextPage = 'auswertung.php';
    }
    else {
        $nextPage = 'question.php';
    }
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="assets/js/main.js"></script>

</head>

<body>

 
<div class="background-q">
        <div class="q-logo-box">
            <img class="logo-q" src="/img/logo-quiz.png" alt="">
        </div>
        <div class="frage-container">
            <h6>Frage <?php echo ($questionCounter + 1); ?> von <?php echo count($quiz['questionIds']);?></h6>
            <p><?php echo $question; ?> </p>
        </div>
        <div class="col-3" style="text-align: right;">
            <div id="timer" style=" font-weight: bold; color: white; z-index: 1;"></div>
        </div>

        <div class="quiz-form">
<form  method="post" action = "<?php echo $nextPage; ?>">

<?php
    
    for ($i=0; $i < count($answers); $i++) { 
        $currAnswerId = $_SESSION['quiz']['answerIds'][$questionCounter][$i];
        echo('  <label class="form-check-label" for= "answers[]">'.$answers[$i].'
                <input class = form-check-input name = "answers[]" type='.$type.' value = '.$currAnswerId.'>
                </label>');
    }
    
?>
<!-- <input type="hidden" id="questionNum" name="questionNum" value="<?php echo $quiz["questionNum"]; ?>">
<input type="hidden" id="lastQuestionIndex" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
<input type="hidden" id="multipleChoice" name="multipleChoice" value="<?php echo $multipleChoice ? 'true':'false'; ?>">
<input type="hidden" id="maxPoints" name="maxPoints" value="<?php echo $maxPoints; ?>">
<input type="hidden" id="indexStep" name="indexStep" value="1"> -->


<div class="quiz-form-floating">
        <button type="submit" class="btn btn-success">Nächste Frage</button>
</div> 
</form>
</div>    
</div>
<?php 
// $_SESSION["session-written"] = true;
// prettyPrint($_SESSION, '$_SESSION');
?>
<!-- <script src="./assets/js/main.js"></script> -->
</body>
</body>

</html>