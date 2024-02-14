<?php
    include "./includes/data-collector.php";
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
    <?php 
        // hole die id der aktuellen frage aus $quiz
        if (isset($quiz["questionIdSequence"])) {
            $id = $quiz["questionIdSequence"][$currentQuestionIndex];
        } 

        //holle alle datenfelder zur Frage mit $id von der DB
        $question = fetchQuestionById($id, $dbConnection);
        
        // //DEVONLY
        // prettyPrint($question, "Question");
         
    ?>
    <div class="background-q">
        <div class="q-logo-box">
            <img class="logo-q" src="/img/logo-quiz.png" alt="">
        </div>
        <div class="frage-container">
            <h6>Frage <?php echo ($currentQuestionIndex + 1); ?> von <?php echo $quiz["questionNum"];?></h6>
            <p><?php echo $question["question_text"]; ?> </p>
        </div>

        <div class="quiz-form">
            <form action="<?php echo $actionUrl;?>" method="post">

                <?php
                    // Single choince: hole den Namen der richtigen Antwortspalte im $correct, aus $question["correct"] 
                    $correct = $question["correct"]; // Zum B.s. den string "1, 3"
                    $pattern = "/\s*,\s*/";  // RegEx-Suchmuster für die Trennzeichen
                    $correctItems = preg_split($pattern, $correct);

                    // Verwandle die ID-Strings in ID-Nummern.
                    foreach($correctItems as $i => $item) {
                        $correctItems[$i] = intval($item);
                    }

                    // Berechne die MAximale mögliche Punktzahl für diese Frage.
                    $maxPoints = count($correctItems);

                    // Entscheide, ob wir single-choice (radio) oder multiple-choice (checkbox)
                    if (count($correctItems)> 1) $multipleChoice = true;
                    else $multipleChoice = false; // bedeutet single-choice

                    for ($a = 1; $a <= 5; $a++) {

                        // Setze für $answerColumnName den Namen der Tabellenspalte "answer-N" zusammen
                        $answerColumnName = "answer_" . $a;
                         if (isset($question[$answerColumnName]) && !empty($question[$answerColumnName])){
                            //... hole den Antworttext aus $question.
                            $answerText = $question[$answerColumnName];

                            if (in_array($a, $correctItems, true)) $value =1;
                            else $value = 0;

                            //Entscheide für $value, wie viele punkte 
                            echo "\n<div class='form-check'>\n";

                            if ($multipleChoice) {

                                echo " <input class='form-check-input' type='checkbox' name='$answerColumnName' value='$value' id='$answerColumnName'>\n";
                            }
                            else {
                                echo " <input class='form-check-input' type='radio' name='single-choice' value='$value' id='$answerColumnName'>\n";
                            }


                            echo " <label class='form-check-label' for='$answerColumnName'>$answerText</label>\n";
                            echo  "</div>\n";
                         }
                    }

                    
                ?>
                <input type="hidden" id="questionNum" name="questionNum" value="<?php echo $quiz["questionNum"]; ?>">
                <input type="hidden" id="lastQuestionIndex" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
                <input type="hidden" id="multipleChoice" name="multipleChoice" value="<?php echo $multipleChoice ? 'true':'false'; ?>">
                <input type="hidden" id="maxPoints" name="maxPoints" value="<?php echo $maxPoints; ?>">
                <input type="hidden" id="indexStep" name="indexStep" value="1">
            
                
                <div class="quiz-form-floating">
                        <button type="submit" class="btn btn-success">Nächste Frage</button>
                </div> 
            </form>
        </div>    
    </div>
    <?php 
        // $_SESSION["session-written"] = true;
        // prettyPrint($_SESSION, '$_SESSION');

    for ($i=0; $i < count($answers); $i++) { 
        $currAnswerId = $_SESSION['quiz']['answerIds']['$questioCounter'][$i];
        echo('  <label class="form-check-label" for='.$currAnswerId.'>'.$answers[$i].'
                <input class = form-check-input name = '.$currAnswerId.' type='.$type.' value = '.$currAnswerId.'>
                </label>');
    }
    ?>

     
<label class="form-check-label" for="$id">
    <input class = form-check-input name = $id type="$type" value = $id>
</label>
</body>

</html>
