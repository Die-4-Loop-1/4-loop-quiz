<?php
function prettyPrint($stuff) {
    echo ('<pre>');
    print_r($stuff);
    echo ('</pre>');
}

// setup
function generateQuiz($topic, $count, $dbConn) {
    $query = $dbConn->prepare("SELECT `question_id` FROM questions WHERE topic = '$topic' ORDER BY RAND() LIMIT $count");
    $query->execute();
    $questionIds = $query->fetchAll(PDO::FETCH_COLUMN);
    // prettyPrint($questionIds);

    foreach ($questionIds as $id) {
        $query = $dbConn->prepare("SELECT `id` FROM answers WHERE `question_id` = $id ORDER BY RAND()");
        $query->execute();
        $answerIds[] = $query->fetchAll(PDO::FETCH_COLUMN);
        $query = $dbConn->prepare("SELECT `id` FROM answers WHERE `question_id` = $id && `is_correct` = 1");
        $query->execute();
        $correctId[] = $query->fetchAll(PDO::FETCH_COLUMN);

        // prettyPrint($questionIds);
        // prettyPrint($answerIds);
        // prettyPrint($correctId);

        //set userAnswers array
        $_SESSION['userAnswers'] = [];
    }
    return [
        'questionIds' => $questionIds,
        'answerIds'   => $answerIds,
        'correctIds'   => $correctId,
    ];
}
function getQuestion($id, $dbConn){
    $query = $dbConn->prepare("SELECT `question_text` FROM questions WHERE `question_id` = $id");
    $query->execute();
    $question = $query->fetch(PDO::FETCH_COLUMN);
    return $question;
}
function getAnswers($ids, $dbConn){
    foreach ($ids as $id) {
        $query = $dbConn->prepare("SELECT `answers_text` FROM answers WHERE `id` = $id");
        $query->execute();
        $answers[] = $query->fetch(PDO::FETCH_COLUMN);
    }
    return $answers;
}


?>