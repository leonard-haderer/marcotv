<?php
//    $directory = "../copi4jpg";
    $directory = "../posters_casse";
    $posterDirectory = '../posters_repare/';
    $list = scandir($directory);

    foreach ($list as $image) {
        if ($image != "." && $image != ".." && $image != "posters") {
            $gdImage = imagecreatefromjpeg("../copi4jpg/" . substr($image, 0, 1) . "/" . $image);
            $smallGdImage = imagecrop($gdImage, ['x' => 465, 'y' => 286, 'width' => 316, 'height' => 433]);
            imagejpeg($smallGdImage, $posterDirectory . $image);
        }
    }
?>
