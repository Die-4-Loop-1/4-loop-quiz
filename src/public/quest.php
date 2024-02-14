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
    <link rel="stylesheet" href="assets/css/q-annim.css" />
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
    <div class="q-canvas">
        <div class="q-container">
            <div class="ball"></div>
            <div class="shadow"></div>
        </div>
    </div>

    <div class="background-q">
        <div class="q-logo-box">
            <img class="logo-q" src="/img/logo-quiz.png" alt="">
        </div>
        <div class="frage-container">
            <h6>Frage <?php echo ($currentQuestionIndex + 1); ?> von <?php echo $quiz["questionNum"]; ?></h6>
            <p><?php echo $question["question_text"]; ?> </p>
        </div>

        <div class="quiz-form">
            <form action="<?php echo $actionUrl; ?>" method="post">

                <?php
                // Single choince: hole den Namen der richtigen Antwortspalte im $correct, aus $question["correct"] 
                $correct = $question["correct"]; // Zum B.s. den string "1, 3"
                $pattern = "/\s*,\s*/";  // RegEx-Suchmuster für die Trennzeichen
                $correctItems = preg_split($pattern, $correct);

                // Verwandle die ID-Strings in ID-Nummern.
                foreach ($correctItems as $i => $item) {
                    $correctItems[$i] = intval($item);
                }

                // Berechne die MAximale mögliche Punktzahl für diese Frage.
                $maxPoints = count($correctItems);

                // Entscheide, ob wir single-choice (radio) oder multiple-choice (checkbox)
                if (count($correctItems) > 1) $multipleChoice = true;
                else $multipleChoice = false; // bedeutet single-choice

                for ($a = 1; $a <= 5; $a++) {

                    // Setze für $answerColumnName den Namen der Tabellenspalte "answer-N" zusammen
                    $answerColumnName = "answer_" . $a;
                    if (isset($question[$answerColumnName]) && !empty($question[$answerColumnName])) {
                        //... hole den Antworttext aus $question.
                        $answerText = $question[$answerColumnName];

                        if (in_array($a, $correctItems, true)) $value = 1;
                        else $value = 0;

                        //Entscheide für $value, wie viele punkte 
                        echo "\n<div class='form-check'>\n";

                        if ($multipleChoice) {

                            echo " <input class='form-check-input' type='checkbox' name='$answerColumnName' value='$value' id='$answerColumnName'>\n";
                        } else {
                            echo " <input class='form-check-input' type='radio' name='single-choice' value='$value' id='$answerColumnName'>\n";
                        }


                        echo " <label class='form-check-label' for='$answerColumnName'>$answerText</label>\n";
                        echo  "</div>\n";
                    }
                }


                ?>
                <input type="hidden" id="questionNum" name="questionNum" value="<?php echo $quiz["questionNum"]; ?>">
                <input type="hidden" id="lastQuestionIndex" name="lastQuestionIndex" value="<?php echo $currentQuestionIndex; ?>">
                <input type="hidden" id="multipleChoice" name="multipleChoice" value="<?php echo $multipleChoice ? 'true' : 'false'; ?>">
                <input type="hidden" id="maxPoints" name="maxPoints" value="<?php echo $maxPoints; ?>">
                <input type="hidden" id="indexStep" name="indexStep" value="1">


                <div class="quiz-form-floating">
                    <button type="submit" class="btn btn-success">Nächste Frage</button>
                </div>
            </form>

        </div>
    </div>
    <audio autoplay loop>
        <source src="audio/questions_background_music.mp3" type="audio/mp3">
    </audio>
    <?php
    // $_SESSION["session-written"] = true;
    // prettyPrint($_SESSION, '$_SESSION');
    ?>
    <script>
        // erstellt von Andreas

        // erstelle manuell ein Array mit drei verschiedenen URLs drin
        let urls = {
            1: "https://de.wikipedia.org/wiki/Hammer",
            0: "https://de.wikipedia.org/wiki/Hammer"
        }


        setTimeout(function() {
            // erstelle einen foreach loop über das array
            for (const key in urls) {

                // erstelle pro url, einen Anchor Tag
                var link = document.createElement("a");

                // füge diesem anchor tag das href Attribut hinzu
                link.href = urls[key];

                // füge dem Anchor Tag ein Label (Text) hinzu
                link.innerHTML = '<div class="question-icon"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M240-80v-172q-57-52-88.5-121.5T120-520q0-150 105-255t255-105q125 0 221.5 73.5T827-615l52 205q5 19-7 34.5T840-360h-80v120q0 33-23.5 56.5T680-160h-80v80h-80v-160h160v-200h108l-38-155q-23-91-98-148t-172-57q-116 0-198 81t-82 197q0 60 24.5 114t69.5 96l26 24v208h-80Zm254-360Zm-14 120q17 0 28.5-11.5T520-360q0-17-11.5-28.5T480-400q-17 0-28.5 11.5T440-360q0 17 11.5 28.5T480-320Zm-30-128h61q0-25 6.5-40.5T544-526q18-20 35-40.5t17-53.5q0-42-32.5-71T483-720q-40 0-72.5 23T365-637l55 23q7-22 24.5-35.5T483-663q22 0 36.5 12t14.5 31q0 21-12.5 37.5T492-549q-20 21-31 42t-11 59Z"/></svg></div>';
                // Füge den Anchor Tag eine Klasse hinzu, die Du dann im CSS stylen kannst
                link.classList.add("custom-link");

                // Füge target atribut mit dem wert _blank hinzu.
                link.target = "_blank";

                // speichere den gewünschten div Container in einer variabel (getElementById, o.Ä.)
                var idContainer = document.querySelector('input[value="' + key + '"]');

                // wähle das obere div an
                let urlContainer = idContainer.parentElement;

                // füge die erstellen Anchor Tags in den Container ein
                urlContainer.appendChild(link);
            }
        }, 10000);
    </script>

</body>

</html>