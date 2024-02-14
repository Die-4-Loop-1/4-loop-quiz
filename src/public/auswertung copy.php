<?php

    include "./includes/data-collector.php";
    // phpinfo();

    // echo get_include_path();
    
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
    <script src="assets/js/main.js"></script>

</head>

<body>

<?php 
    /*
    Betimme die Anzahl der ereichten Punkte. Dazu wird das 'value' -Attribut der Eingabefelder ausgewertet.
    
    Wichtig: Sämtliche $_SESSION-werte müssen fertig gesetzt sein. bevor die Punktzahlen gesammelt werden dürfen.*/

    $totalPoints = 0;
    $maxTotalPoints = 0;

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
            $maxTotalPoints = $maxTotalPoints + intval($data["maxPoints"]);
        }
    }
        
?>
    <div class="background-a">
        <div class="last-container">
        <div class="a-logo-box">
            <img class="logo-q" src="/img/logo-quiz.png" alt="">
        </div>
            <p>Herzlichen <br>Glückwunsch</p>
        </div>
        <div class="auswertung-text">
            <p><?php $prozentErgebnis = $totalPoints * 100 / $maxTotalPoints;
        if ($prozentErgebnis > 70) {
            echo "<p> Gut gemacht, weiter so.</p>";
        } elseif ($prozentErgebnis >= 40 && $prozentErgebnis <= 70) {
           echo "<p>Sie können es noch Besser</p>";
        } else {
           echo "<p>Klicken Sie doch nicht einfach durch";
        }?></p>


            <p>Sie haben <?php echo $totalPoints; ?> von <?php echo $maxTotalPoints; ?> möglichen Punkten erreicht.</p>
        </div>
        
                <div class="auswertung-bnt">
                    <a href="index.php">
                        <button type="button" class="btn btn-success">Neues Quiz</button>
                    </a>
                </div>              
               
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>