<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
$image = imagecreatefromjpeg('img/chessboard.jpg');
$resolution = 10;
$width = imagesx($image);
$height = imagesy($image);
// list($width, $height) = getimagesize($image);
$aspectRatio = $width / $height;
$hIndex = ceil($height / ($resolution / $aspectRatio));
$wIndex = ceil($width / $resolution);
$imgCounter = 0;    

$outputDirectory = __DIR__ . '/cutterImgs/';
chmod($outputDirectory, 0777);
for ($i=0; $i < $height / $hIndex; $i++) {
    for ($j=0; $j < $width / $wIndex; $j++) {
        $area = ['x' => $wIndex * $j, 'y' => $hIndex * $i, 'width' => $wIndex, 'height' => $hIndex];
        
         // Crop the image
            $croppedImage = imagecrop($image, $area);
            
            if ($croppedImage !== false) {
                // Store the cropped image in the array
                
                // $images[] = $croppedImage;
                $filename = $outputDirectory . '/cropped_image_' . $imgCounter . '.jpg';

                // Save the cropped image as JPEG to the specified filename
                imagejpeg($croppedImage, $filename);

                // Free up memory
                imagedestroy($croppedImage);
            }
            $imgCounter++;
        }
 }
 
 
 // Display the images
//  foreach ($images as $img) {
//      echo '<img src="data:image/jpeg;base64,' . base64_encode(imagejpeg($img, null, 100)) . '" />';
//      imagedestroy($img); // Free up memory
//  }  

// Load the image
// $image = imagecreatefromjpeg('original.jpg');

// Define the rectangular area to crop
// $rect = ['x' => $wIndex * $j, 'y' => $hIndex * $i, 'width' => $wIndex, 'height' => $hIndex];

// Crop the image
// $croppedImage = imagecrop($image, $rect);

// Output the cropped image to a file
// imagejpeg($croppedImage, 'cropped.jpg');

// Free up memory
// imagedestroy($image);
// imagedestroy($croppedImage);

// Get the size of the image
// $imageInfo = getimagesize('image.jpg');

// Extract width and height from the returned array
// $width = $imageInfo[0]; // width is at index 0
// $height = $imageInfo[1]; // height is at index 1

// echo "Width: $width, Height: $height";

$jsonImages = json_encode($image);
echo("<script> let images = " . $jsonImages . "</script>");





$imgs = json_encode(scandir($outputDirectory));
?>
<script>
    let imgs = <?php echo $imgs; ?>;
    imgs.forEach(imgLink => {
        // Create an image element
    let image = document.createElement('img');

   
    image.src = `path/to/your/${imgLink}`;


    // // Create a container element
    // var container = document.createElement('div');

    // // Append the image to the container
    // container.appendChild(image);

    // Append the container to the document body
    document.body.appendChild(image);
    });
</script>
