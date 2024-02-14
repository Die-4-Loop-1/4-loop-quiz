
<?php

function prettyERPrint($stuff) {
    echo ('<pre>');
    print_r($stuff);
    echo ('</pre>');
}
$image = imagecreatefromjpeg('img/chessboard.jpg');
$resolution = 100;
$width = imagesx($image);
$height = imagesy($image);
prettyERPrint($width);
// list($width, $height) = getimagesize($image);
$aspectRatio = $width / $height;
$hIndex = ceil($height / ($resolution / $aspectRatio));
$wIndex = ceil($width / $resolution);
$imgCounter = 0;

$outputDirectory = 'cutterImgs/';
chmod($outputDirectory, 0777);
for ($i=0; $i < $height / $hIndex; $i++) {
    for ($j=0; $j < $width / $wIndex; $j++) {
        $area = ['x' => $wIndex * $j, 'y' => $hIndex * $i, 'width' => $wIndex, 'height' => $hIndex];
        
         // Crop the image
            $croppedImage = imagecrop($image, $area);
            
            if ($croppedImage !== false) {
                // Store the cropped image in the array
                
                // $images[] = $croppedImage;
                $filename = $outputDirectory . 'pix' . $imgCounter . '.jpg';
                $filenames[] = $filename;
                // Save the cropped image as JPEG to the specified filename
                imagejpeg($croppedImage, $filename);

                // Free up memory
                imagedestroy($croppedImage);
            }
            $imgCounter++;
        }
 }
 
$jsonImages = json_encode($image);

$jsonFilenames = json_encode($filenames);
echo("<script> let images = " . $jsonFilenames . "</script>");
echo("<script> let resolution = " . $resolution . "</script>");

$imgs = json_encode(scandir($outputDirectory));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    body {
        background-color: black;
    }
    img {
            /* margin: 3px;
            width: 100%;
            height: auto; */
        }
        #imageContainer {
            display: flex;
            flex-wrap: wrap;
            position: absolute;
            top: 10%; /* toDel */
            left: 10%; /* toDel */
            width: <?php echo($width) ?>px;
            transform: scale(1.5);
        }
</style>
</head>
<body>
    <div id="imageContainer">

    </div>
<!-- <canvas id="myCanvas" width="500" height="195"></canvas> -->
</body>
<script>
    for (let i = 0; i < images.length; i++) {
    let image = document.createElement('img');
    image.src = images[i];
    document.getElementById('imageContainer').appendChild(image);
}

let theWholeBunch = document.querySelectorAll(img);
let theRandomBunch = shuffle(theWholeBunch);

for (let i = 0; i < theWholeBunch.length; i++) {
    const element = array[i];
}
</script>
</html>
