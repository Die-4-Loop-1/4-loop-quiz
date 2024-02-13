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
        margin: 3px;
    }
</style>
</head>
<body>
<canvas id="myCanvas" width="300" height="195"></canvas>
</body>
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


<script>
    for (let i = 0; i < images.length; i++) {
        let image = document.createElement('img');
        image.src = images[i];
        document.body.appendChild(image);
        if((i+1) !== 0 && (i+1) % resolution === 0) {
            document.body.appendChild(document.createElement('br'));
        }
    }
    images.forEach(imgLink => {
        console.log(imgLink);
    let image = document.createElement('img');
    image.src = imgLink;
    document.body.appendChild(image);
    });
    // let canvas = document.getElementById('myCanvas');
    // let ctx = canvas.getContext('2d');

    // let imageWidth = 3;
    // let imageHeight = 3;
    
    // let x = 0;
    // let y = 0;

    // images.forEach((imgLink, i) => {
    //     let image = new Image();
    //     image.onload = function() {
    //         ctx.drawImage(image, x, y, imageWidth, imageHeight);
    //         x += imageWidth;
    //         if((i+1) !== 0 && (i+1) % resolution === 0) {
    //             x = 0;
    //             y += imageHeight;
    //         }
    //     };
    //     image.src = imgLink;
    // });



  

</script>
</html>
