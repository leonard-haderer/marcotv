<?php
    $directory = "../copi4jpg";
    $posterDirectory = '../posters/';
    $list = scandir($directory);
    if ($list) {
        $response = array();
        foreach ($list as $image) {
            if ($image != "." && $image != ".." && $image != "posters") {
                $gdImage = imagecreatefromjpeg("copi4jpg/" . $image);
                $smallGdImage = imagecrop($gdImage, ['x' => 467, 'y' => 285, 'width' => 316, 'height' => 433]);
                imagejpeg($smallGdImage, $posterDirectory . $image);
            }
        }
    }
?>
