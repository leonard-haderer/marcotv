<?php
    header('Access-Control-Allow-Origin: *'); // To be able to call this with an ajax call from another site.
    $file_map_id_title = "map_id_title.txt";
    $file_map_id_card = "map_id_card.txt";
    $posterDirectory = 'posters';
    $descriptionDirectory = 'copi4jpg';

    $response = array();
    $response["code"] = 0;
    $response["message"] = "OK";
    $response["content"] = array();

    $string_map_id_card = file_get_content($file_map_id_card);
    $map_id_card = array();
    foreach (explode("\n", $string_map_id_card) as $id_card) {
        $exploded_id_card = explode(" ", $id_card);
        $map_id_card[$exploded_id_card[0]] = $exploded_id_card[1];
    }

    $string_map_id_title = file_get_content($file_map_id_title);
    foreach (explode("\n", $string_map_id_title) as $id_title) {
        $exploded_id_title = explode(" ", $id_title);
        $id = $exploded_id_title[0];
        $title = $exploded_id_title[1];
        $element = array();
        $element["id"] = $id;
        $element["title"] = str_replace("_", " ", $title);
        $element["card"] = $map_id_card[$id];
        $element["description"] = $descriptionDirectory . "/" . substr($title, 0, 1) . "/" . $title . ".jpg";
        $element["poster"] = $posterDirectory . "/" . substr($title, 0, 1) . "/" . $title . ".jpg";
        array_push($response["content"], $element);
    }

    echo(json_encode($response, JSON_UNESCAPED_SLASHES));
?>
