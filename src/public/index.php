<?php
session_start();
session_unset();
session_destroy();
include "./includes/collector.php"; // Muss zuerst sein wegen Start _SESSION()
    // phpinfo();

    // echo get_include_path();
    //  include './includes/db.php';
    ?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz-Time</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="assets/js/main.js"></script>

</head>

<body>
    <div class="background">
        <div class="img-logo">
            <img class="logo" src="/img/logo-quiz.png" alt="">
        </div>
        <div class="green-box">
            <form id="quiz-form" action="question.php" method="post" onsubmit="return navigate('next');">
                <div class="form-floatin">
                    <label for="quiz-topic" class="form-label"></label>
                    <select class="form-select" id="topic" name="topic" aria-label="Default select example">
                        <option selected>Quiz Thema - Bitte auswählen</option>
                        <option value="cinema">Cinema</option>
                        <option value="tech">Tech</option>
                        <option value="tierwelt">Tierwelt</option>
                        <option value="animals">Animals</option>
                        <option value="ch-norris">Chuck Norris</option>
                        <option value="tiere">Tiere</option>
                        <option value="geography">Geography</option>
                        <option value="astronomie">Astronomie</option>
                        <option value="history">History</option>
                        <option value="werkzeuge">Werkzeuge</option>
                    </select>
                          
                </div>
                <div class="form-floatin">
                    <div class="mb-3">
                        <label for="questionNum" class="form-label">Wie viele Fragen möchten Sie beantworten</label>
                        <input type="number" class="form-control" id="questionNum" placeholder="Geben Sie eine Zahl ein"
                        name="questionNum" 
                        min="2" max="40" value="10">
                    </div> 

                    <!-- lastQuestionIndex: mit PHP gesetzt -->
                    <input type="hidden" id="lastQuestionIndex" name="lastQuestionIndex" value="-1">
                    <!-- indexStep: mit JavaScript setIntValue(fieldId, value) verändert -->
                    <input type="hidden" id="indexStep" name="indexStep" value="1">

                    <div class="form-floatin">
                        <input type="submit" class="btn btn-success" value="Quiz Starten">
                    </div>
            </form> 
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>