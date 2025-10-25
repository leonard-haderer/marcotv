<?php

    $mainDir = "../posters";
    $mainList = scandir($mainDir);
    foreach ($mainList as $directory) {
        if ($directory != "." && $directory != ".." && is_dir($mainDir . "/" . $directory)) { // && $directory == "1"

            $list = scandir($mainDir . "/" . $directory);
           
            $resultImage = imagecreatetruecolor(1, 2165);
            $index = 0;
            foreach ($list as $image) {
                if ($image != "." && $image != "..") {
                    $width = floor($index / 5) * 316;
                    if ($index == 0) {
                        $resultImage = imagecreatetruecolor(316, 2165);
                    } else if (($index % 5) == 0) {
                        $newResultImage = imagecreatetruecolor($width + 316, 2165);
                        imagecopy($newResultImage, $resultImage, 0, 0, 0, 0, $width, 2165);
                        $resultImage = $newResultImage;
                    }
                    $gdImage = imagecreatefromjpeg($mainDir . "/" . $directory . "/" . $image);
                    echo("$image : $width, " . (433 * ($index % 5)) . ", 0, 0, 316, 433)\n");
                    imagecopy($resultImage, $gdImage, $width, 433 * ($index % 5), 0, 0, 316, 433);
                    $index++;
                }
            }

            imagejpeg($resultImage, $mainDir . "/" . $directory . ".jpg");

        }
    }
?>
