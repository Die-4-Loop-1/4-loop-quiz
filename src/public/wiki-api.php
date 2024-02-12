<?PHP

include 'includes/tools.php';
include 'includes/db.php';
$dbConn = $dbConnection;
$maVar = 'Distribute incoming network traffic';

$id =115;

$data = $dbConn->query("SELECT * FROM `questions` JOIN `answers` ON questions.question_id = answers.question_id 
WHERE questions.question_id = $id AND answers.is_correct = 1")->fetchAll(PDO::FETCH_ASSOC);

// prettyERPrint($data);
prettyERPrint($data[0]['answers_text']);
$answerString = $data[0]['answers_text'];
$language = 'en';
if (in_array($data[0]['topic'], ['tierwelt', 'history', 'tiere', 'werkzeuge'])) {
    $language = 'de';
}

function compareByLength($a, $b) {
    return strlen($b) - strlen($a);
}

function getWikiLink($serchString, $language) {
    $uencAnswer = urlencode($serchString);
    prettyERPrint($uencAnswer);
    $apiUrl = 'https://'.$language.'.wikipedia.org/w/api.php?action=opensearch&search='.$uencAnswer.'&limit=1&namespace=0&format=json';
    $data = json_decode(file_get_contents($apiUrl), true);
    if (isset($data[3][0])) {
        return $data[3][0];
    }   
    
}
function wiki($answerString, $language) {
    $correctAnswers = explode(' ', $answerString);
    usort($correctAnswers, 'compareByLength');
    prettyERPrint($correctAnswers);

    $link = getWikiLink($answerString, $language);
    if ($link !== null) {
        return $link;
    }
    else {
        foreach ($correctAnswers as $correctAnswer) {
            $link = getWikiLink($correctAnswer, $language);
            if ($link !== null) {
                return $link;
            }
        }
    }
}
$link = wiki($answerString, $language);
prettyERPrint($link);

    
// https://de.wikipedia.org/w/api.php
// ?action=opensearch
// &search=gehrungssäge
// &limit=1
// &namespace=0
// &format=json


// links = {
//     1001 : www.wiki/hammer,
//     1004 : www.wiki/hammer,
// }
// links.forEach(function(id, link) {
//     let element = document.querySelector('input[value="' + id + '"]');
//     element.
// });

?>