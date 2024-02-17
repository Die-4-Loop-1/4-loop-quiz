
<?php

function prettyPrint($stuff) {
    echo ('<pre>');
    print_r($stuff);
    echo ('</pre>');
}

emptyFolder('cutterImgs/');
$image = imagecreatefromjpeg('wikiImgs/resizedWikiPic.jpg');
$width = imagesx($image);
$height = imagesy($image);
$aspectRatio = $width / $height;
$actualRes = $width * $height;
$resolution = 50;
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
            $filename = $outputDirectory . 'pix' . $imgCounter . '.jpg';
            
            // Save the cropped image as JPEG to the specified filename
            imagejpeg($croppedImage, $filename);

            $filenames[] = $filename;
            imagedestroy($croppedImage);
            $imgCounter++;
            
        }
 }
 


// $jsonFilenames = json_encode($filenames);
// prettyPrint($jsonFilenames);
echo ("<script> 
let haveImage = " . json_encode($haveImage) . ";
console.log(haveImage);
let images = " . json_encode($filenames) . "; 
let resolution = " . json_encode($actualRes) . ";
let imgCounter = " . json_encode($imgCounter) . ";
let countdown = " . 10 . ";
</script>");

// $imgs = json_encode(scandir($outputDirectory));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    body {
        background-color: grey;
    }
img {
    display: inline-block;
    max-width: 100%; 
    height: auto; 
    opacity: 0;
    z-index: 3;
        
            
}
#imageContainer {
    
    display: flex;
    flex-wrap: wrap;
    position: absolute;
    background-color: black;
    /* min-height: 100px; */ /*If you don't want it to grow from zero, uncomment this.*/
    top: 10%; /* toDel */
    left: 10%; /* toDel */
    width: 400px;
    border: 5px solid #333;
}
#imageContainer::after {
    content: "";
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    border-radius: 10px;
    padding: 15px;
    border: 5px solid #333;
    background-color: white;
    z-index: -1; /* Ensure the pseudo-element is behind the container content */
    
}

#imageContainer::before {
    content: "";
    position: absolute;
    z-index: 2; 
    background: 
        url('data:image/svg+xml;utf8,<svg style="transform:rotate(45deg)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 60"><text x="0" y="25" fill="%23444"> VisualAid </text></svg>') 
        0 0/75px 40px;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
</head>
<body>
    <div id="imageContainer">

    </div>
<!-- <canvas id="myCanvas" width="500" height="195"></canvas> -->
</body>
<script>
function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}
for (let i = 0; i < images.length; i++) {
    let image = document.createElement('img');
    image.src = images[i];
    document.getElementById('imageContainer').appendChild(image);
}
console.time('bunch up');
let theWholeBunch = Array.from(document.querySelectorAll('img'));
let theRandomBunch = shuffle(theWholeBunch);
let delay = (countdown *1000) / (imgCounter * .6);
console.timeEnd('bunch up');
window.onload = function() {
    for (let i = 0; i < imgCounter; i++) {
        setTimeout(() => {
            theRandomBunch[i].style.opacity = 1;
        }, delay*i)
    }
}
</script>
</html>
