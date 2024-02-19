<!DOCTYPE html>
<script> console.time('page loaded'); </script>

<?php
$start = microtime(true);

//adjust width of imageContainer in pixel
$containerWidth = 400;
$countdown = 10;
$haveImage = false;

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
    include 'wiki-api.php';
    


    $quiz = $_SESSION['quiz'];
    $questionId = $quiz['questionIds'][$questionCounter];
    $question = getQuestion($questionId, $dbConn);
    $answers = getAnswers($_SESSION['quiz']['answerIds'][$questionCounter], $dbConn);
    $links = wikinator($questionId, $dbConn, $containerWidth);

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

<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/cutterImageContiner.css">
    <link rel="stylesheet" href="assets/css/q-annim.css">
    <script src="assets/js/cutter.js" defer></script>
    <script src="assets/js/main.js" defer></script>
    

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
        echo('  <label class="form-check-label questionBtn" for= "answers'.$i.'">'.$answers[$i].'
                <input class = form-check-inputw" id="answers'.$i.'" name = "answers[]" type='.$type.' value = '.$currAnswerId.'>
                </label>');
    }
  
?>

<div class="quiz-form-floating">

        <button type="submit" class="btn btn-success">Nächste Frage</button>
</div> 
<div style="width: <?php echo($containerWidth).'px'; ?>;" id="imageContainer"></div> <!--move where needed, adjust width at the top-->
</form>
</div>    
</div>





<?php
    echo("<script>
        let urls = " . json_encode($links) . ";
        </script>");
?>

<script> 
    let haveImage = <?php echo json_encode($haveImage); ?>;
    // console.log(haveImage);
    let images = <?php echo json_encode($filenames); ?>; 
    let resolution = <?php echo json_encode($actualRes); ?>;
    let imgCounter = <?php echo json_encode($imgCounter); ?>;
    let countdown = <?php echo json_encode($countdown); ?>;
</script>


</body>
<?php
$end = microtime(true);
$totalTime = $end - $start;
logger(); // comment or delete this line to remove the logging call
?>
</html>