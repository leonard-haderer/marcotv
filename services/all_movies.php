<?php
    //header('Access-Control-Allow-Origin: *'); // To be able to call this with an ajax call from another site.
    $file_map_id_title = "map_id_title.txt";
    $file_map_id_card = "map_id_card.txt";
    $mainDir = "..";
    $posterDirectory = 'posters';
    $descriptionDirectory = 'copi4jpg';

    $response = array();
    $response["code"] = 0;
    $response["message"] = "OK";
    $response["content"] = array();

    $elements = scandir($mainDir . "/" . $posterDirectory);
    $posterPositions = array();
    foreach ($elements as $element) {
        if ($element != "." && $element != ".." && is_dir($mainDir . "/" . $posterDirectory . "/" . $element)) {
            $posters = scandir($mainDir . "/" . $posterDirectory . "/" . $element);
            $index = 0;
            foreach ($posters as $poster) {
                if ($poster != "." && $poster != "..") {
                    $posterPositions[$poster] = $index;
                    $index++;
                }
            }
        }
    }

    $string_map_id_card = file_get_contents($file_map_id_card);
    $map_id_card = array();
    foreach (explode("\n", $string_map_id_card) as $id_card) {
        $exploded_id_card = explode(" ", $id_card);
        if (sizeof($exploded_id_card) >= 2) {
            $map_id_card[$exploded_id_card[0]] = $exploded_id_card[1];
        }
    }

    $string_map_id_title = file_get_contents($file_map_id_title);
    foreach (explode("\n", $string_map_id_title) as $id_title) {
        $exploded_id_title = explode(" ", $id_title);
        if (sizeof($exploded_id_title) >= 2) {
            $id = $exploded_id_title[0];
            $title = $exploded_id_title[1];
            $element = array();
            $element["id"] = $id;
            $element["title"] = str_replace("_", " ", $title);
            $element["card"] = $map_id_card[$id];
            $element["description"] = $descriptionDirectory . "/" . substr($title, 0, 1) . "/" . $title . ".jpg";
            $element["poster"] = $posterDirectory . "/" . substr($title, 0, 1) . ".jpg";
            $element["postery"] = 433 * ($posterPositions[$title . ".jpg"] % 5);
            $element["posterx"] = 316 * (floor($posterPositions[$title . ".jpg"] / 5));
            array_push($response["content"], $element);
        }
    }

    echo(json_encode($response, JSON_UNESCAPED_SLASHES));
?>
