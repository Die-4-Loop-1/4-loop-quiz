<?php
// Resolution refers to the number of pictures generated to fill one horizontal row. 
// Please adjust it carefully, as Opportunity Laptops may experience performance issues aka crashing.
$resolution = 20;
$countdown = 10;
$startCutter = microtime(true);
emptyFolder('cutterImgs/');
$startCutting = microtime(true);
$GLOBALS['timeToStartCutting'] = round($startCutting - $startCutter, 2);
$image = imagecreatefromjpeg('wikiImgs/resizedWikiPic.jpg');
$width = imagesx($image);
$height = imagesy($image);
$aspectRatio = $width / $height;
$GLOBALS['actualRes'] = $width * $height;
$actualRes = $width * $height;
$hIndex = ceil($height / ($resolution / $aspectRatio));
$wIndex = ceil($width / $resolution);
$imgCounter = 0;
$filenames = [];
$outputDirectory = 'cutterImgs/';
chmod($outputDirectory, 0777);
$startCutting = microtime(true);
$GLOBALS['timeToStartCutting'] = round($startCutting - $startCutter, 2);
for ($i=0; $i < floor($height / $hIndex); $i++) {
    for ($j=0; $j < floor($width / $wIndex); $j++) {
        $area = ['x' => $wIndex * $j, 'y' => $hIndex * $i, 'width' => $wIndex, 'height' => $hIndex];
        
            // Crop the image
            $croppedImage = imagecrop($image, $area);
            if ($croppedImage !== false && imagesx($croppedImage) > 0 && imagesy($croppedImage)) {
                $filename = $outputDirectory . 'pix' . $imgCounter . '.jpg';
                
                // Save the cropped image as JPEG to the specified filename
                imagejpeg($croppedImage, $filename);

                $filenames[] = $filename;
                imagedestroy($croppedImage);
                $imgCounter++;
            }
        }
}
$GLOBALS['imgCounter'] = $imgCounter;
$GLOBALS['filenames'] = $filenames;
$endCutting = microtime(true);
$GLOBALS['cutting'] = round($endCutting - $startCutting, 2);
// $filenames = array_slice(scandir('cutterImgs/'), 2);

$startJsLink = microtime(true);

echo ("<script> 
let haveImage = " . json_encode($haveImage) . ";
console.log(haveImage);
let images = " . json_encode($filenames) . "; 
let resolution = " . json_encode($actualRes) . ";
let imgCounter = " . json_encode($imgCounter) . ";
let countdown = " . json_encode($countdown) . ";
</script>");
$endJsLink = microtime(true);
$GLOBALS['jsLink'] = round($endJsLink - $startJsLink, 2);

