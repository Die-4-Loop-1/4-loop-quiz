<?PHP

include 'includes/tools.php';
include 'includes/db.php';
$dbConn = $dbConnection;
$maVar = 'Distribute incoming network traffic';

$id = 100;
$links = wikinator($id, $dbConn);
prettyERPrint($links);

function wikinator($id, $dbConn) {
    $data = $dbConn->query("SELECT * FROM `questions` JOIN `answers` ON questions.question_id = answers.question_id 
    WHERE questions.question_id = $id AND answers.is_correct = 1")->fetchAll(PDO::FETCH_ASSOC);

    $language = 'en';
    if (in_array($data[0]['topic'], ['tierwelt', 'history', 'tiere', 'werkzeuge'])) {
        $language = 'de';
    }

    foreach ($data as $qData) {
        $id = $qData['id'];
        $answerString = $qData['answers_text'];
        $link = wiki($answerString, $language);
        $voila[$id] = $link;
        getPicture($link, $language);
    }
    return $voila;
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

function getWikiLink($searchString, $language) {
    $uencAnswer = urlencode($searchString);
    prettyERPrint($uencAnswer);
    $apiUrl = 'https://'.$language.'.wikipedia.org/w/api.php?action=opensearch&search='.$uencAnswer.'&limit=1&namespace=0&format=json';
    $data = json_decode(file_get_contents($apiUrl), true);
    if (isset($data[3][0])) {
        return $data[3][0];
    }   
    
}

function getPicture($link, $language) {
    emptyFolder('wikiImgs/');
    $parts = explode("/", $link);
    $lastString = end($parts);
    $apiUrl = 'http://'.$language.'.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&pilicense=any&titles='.$lastString;
    $data = json_decode(file_get_contents($apiUrl), true);
    
    // prettyERPrint($data);
    $picLink = null;
    if (isset($data['query']['pages']) && is_array($data['query']['pages'])) {
        foreach ($data['query']['pages'] as $page) {
            if (isset($page['original']['source'])) {
                $picLink = $page['original']['source'];
                $options = array(
                    'http' => array(
                        'method' => 'GET',
                        'header' => "User-Agent: MyBot/1.0\r\n" // Replace 'MyBot/1.0' with a meaningful identifier
                    )
                );
            
            $context = stream_context_create($options);
            $image = file_get_contents($picLink, false, $context);
            chmod('wikiImgs/', 0777);
            file_put_contents('wikiImgs/wikiPic.jpg', $image);
            // $image = file_get_contents($picLink);
            // file_put_contents('wikiImgs/wikiPic.jpg', $image);
        }
    }       
}
}

function emptyFolder($directory) {
    $files = scandir($directory);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            unlink($directory . $file);
        }
}
}

function compareByLength($a, $b) {
    return strlen($b) - strlen($a);
}
// $data = $dbConn->query("SELECT * FROM `questions` JOIN `answers` ON questions.question_id = answers.question_id 
// WHERE questions.question_id = $id AND answers.is_correct = 1")->fetchAll(PDO::FETCH_ASSOC);

// prettyERPrint($data);
// prettyERPrint($data[0]['answers_text']);
// $answerString = $data[0]['answers_text'];
// $language = 'en';
// if (in_array($data[0]['topic'], ['tierwelt', 'history', 'tiere', 'werkzeuge'])) {
//     $language = 'de';
// }





// $link = wiki($answerString, $language);
// prettyERPrint($link);

    
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