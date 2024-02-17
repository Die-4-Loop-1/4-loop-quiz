<?PHP


include 'includes/db.php';

$maVar = 'Distribute incoming network traffic';

$id = 35;
$links = wikinator($id, $dbConn);
// prettyPrint($links);

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

function wikinator($id, $dbConn) {
    $start = microtime(true);
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
    $end = microtime(true);
    $executionTime = $end - $start;
    echo "Execution time Wiki-api: " . $executionTime . " seconds";
    return $voila;
}

function wiki($answerString, $language) {
    $correctAnswers = explode(' ', $answerString);
    usort($correctAnswers, 'compareByLength');
    // prettyPrint($correctAnswers);

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
    // prettyPrint($uencAnswer);
    $apiUrl = 'https://'.$language.'.wikipedia.org/w/api.php?action=opensearch&search='.$uencAnswer.'&limit=1&namespace=0&format=json';
    $data = json_decode(file_get_contents($apiUrl), true);
    if (isset($data[3][0])) {
        return $data[3][0];
    }   
    
}
$haveImage = false;
function getPicture($link, $language) {
    emptyFolder('wikiImgs/');
    $parts = explode("/", $link);
    $lastString = end($parts);
    $apiUrl = 'http://'.$language.'.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&pilicense=any&titles='.$lastString;
    $data = json_decode(file_get_contents($apiUrl), true);
    
    
    $picLink = null;
    if (isset($data['query']['pages']) && is_array($data['query']['pages'])) {
        foreach ($data['query']['pages'] as $page) {
            if (isset($page['original']['source'])) {
                $haveImage = true;
                echo('got one');
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
                
                // Load the image from file
                $source_image = imagecreatefromjpeg('wikiImgs/wikiPic.jpg');

                // Get the dimensions of the source image
                $source_width = imagesx($source_image);
                $source_height = imagesy($source_image);

                // Set the desired width and height for the resized image
                $target_width = 400; // Desired width
                $target_height = intval($source_height * ($target_width / $source_width)); // Maintain aspect ratio

                // Create a new blank image with the target dimensions
                $resized_image = imagecreatetruecolor($target_width, $target_height);

                // Resize the source image to the target dimensions
                imagecopyresampled($resized_image, $source_image, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height);

                // Save the resized image to a file
                imagejpeg($resized_image, 'wikiImgs/resizedWikiPic.jpg');

                // Free up memory
                imagedestroy($source_image);
                imagedestroy($resized_image);
                include 'cutter.php';
                
        }
    }       
}
}



?>