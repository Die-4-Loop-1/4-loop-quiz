<?PHP
include 'includes/db.php';



//for current question
//generates links to wikipedia for correct answers.
//calls cutter if valid picture is found. 
function wikinator($id, $dbConn, $containerWidth) {
    $startWikiApi = microtime(true);
    $data = $dbConn->query("SELECT * FROM `questions` JOIN `answers` ON questions.question_id = answers.question_id 
    WHERE questions.question_id = $id AND answers.is_correct = 1")->fetchAll(PDO::FETCH_ASSOC);

    $language = 'en';
    if (in_array($data[0]['topic'], ['tierwelt', 'history', 'tiere', 'werkzeuge'])) {
        $language = 'de';
    }
    $index = 0;
    foreach ($data as $qData) {
        $id = $qData['id'];
        $answerString = $qData['answers_text'];
        ${"startGetLink" . ($index + 1)} = microtime(true);
        $link = wiki($answerString, $language);
        ${"endGetLink" . ($index + 1)} = microtime(true);
        $GLOBALS['getLink'][$index] = round(${"endGetLink" . ($index + 1)} - ${"startGetLink" . ($index + 1)}, 2);
        $toggle = false;
        if (!$toggle) {
            $toggle = 1;
            $GLOBALS['startGetPicture'] = microtime(true);
            getPicture($link, $language, $containerWidth);
        }
        
        $voila[$id] = $link;
        $index++;
    }
    

    $endWikiApi = microtime(true);
    $GLOBALS['wikiExecutionTime'] = round($endWikiApi - $startWikiApi, 2);
    return $voila;
}

//generate link from correct answer string
function wiki($answerString, $language) {
    //check whole answer
    $link = getWikiLink($answerString, $language);
    if ($link !== null) {
        return $link;
    }
    else {
        //check word by word. longest first
        $correctAnswers = explode(' ', $answerString);
        usort($correctAnswers, 'compareByLength');
        foreach ($correctAnswers as $correctAnswer) {
            $link = getWikiLink($correctAnswer, $language);
            if ($link !== null) {
                return $link;
            }
        }
    }
}

//makes a search on Wikipedia. returns first result as link
function getWikiLink($searchString, $language) {
    $uencAnswer = urlencode($searchString);
    $apiUrl = 'https://'.$language.'.wikipedia.org/w/api.php?action=opensearch&search='.$uencAnswer.'&limit=1&namespace=0&format=json';
    $data = json_decode(file_get_contents($apiUrl), true);
    if (isset($data[3][0])) {
        return $data[3][0];
    }     
}

//gets pictures and starts cutter, still funky when multiple found
function getPicture($link, $language, $containerWidth) {
    global $haveImage;
    $haveImage = false;
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
                // echo('got one');
                $picLink = $page['original']['source'];
                $options = array(
                    'http' => array(
                        'method' => 'HEAD',
                        'header' => "User-Agent: MyBot/1.0\r\n"
                    )
                );
                $context = stream_context_create($options);
            
                $headers = get_headers($picLink, 1, $context);
                if (isset($headers['content-type']) && $headers['content-type'] == 'image/jpeg') {
                    // echo "The file is a JPEG image.";
                    $options = array(
                        'http' => array(
                            'method' => 'GET',
                            'header' => "User-Agent: MyBot/1.0\r\n"
                        )
                    );
                    $context = stream_context_create($options);
                    // Proceed with downloading the image
                    $image = file_get_contents($picLink, false, $context);
                    chmod('wikiImgs/', 0777);
                    file_put_contents('wikiImgs/wikiPic.jpg', $image);
                    
                    // Load the image from file 
                    $source_image = imagecreatefromjpeg('wikiImgs/wikiPic.jpg');
                    // Get the dimensions of the source image
                    $source_width = imagesx($source_image);
                    $source_height = imagesy($source_image);

                    $target_height = intval($source_height * ($containerWidth / $source_width)); // Maintain aspect ratio

                    // Create a new blank image with the target dimensions
                    $resized_image = imagecreatetruecolor($containerWidth, $target_height);

                    // Resize the source image to the target dimensions
                    imagecopyresampled($resized_image, $source_image, 0, 0, 0, 0, $containerWidth, $target_height, $source_width, $source_height);

                    // Save the resized image to a file
                    imagejpeg($resized_image, 'wikiImgs/resizedWikiPic.jpg');
                    include 'cutter.php';
                    // Free up memory
                    imagedestroy($source_image);
                    imagedestroy($resized_image); 
                }
        }
    }       
}
// $i = 1;
// getPicture($link, $language, $containerWidth);
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

function logger() {
    // sleep(15);
    echo "Get rid of logging by comment/delete logger functioncall in questions.php at the bottom. ca. line 132<br><br>";
    global $wikiExecutionTime, $getLink, $timeToStartCutting, $cutting, $jsLink, $totalTime;
    echo "Execution time Wiki-api: " . $wikiExecutionTime . " seconds<br>";
    $i = 1;
    foreach ($getLink as $link) {
        echo "Execution time Link ".$i.": " . $link . " seconds<br>";
        $i++;
    }
    echo "Time to start cutting: " . $timeToStartCutting . " seconds<br>";
    echo "Execution time cutting: " . $cutting . " seconds<br>";
    echo "Execution time js-link: " . $jsLink . " seconds<br>";
    echo "Execution time Page: " . $totalTime . " seconds<br><br><br>";
}