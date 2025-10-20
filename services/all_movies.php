<?php
    $directory = "../copi4jpg";
    $posterDirectory = 'posters/';
    $list = scandir($directory);
    if ($list) {
        $response = array();
        $response["code"] = 0;
        $response["message"] = "OK";
        $response["content"] = array();
        foreach ($list as $movie) {
            if ($movie != "." && $movie != ".." && $movie != "posters") {
                $element = array();
                $element["title"] = str_replace("_", " ", explode(".", $movie)[0]);
                $element["poster"] = $posterDirectory . $movie;
                array_push($response["content"], $element);
            }
        }
        echo(json_encode($response, JSON_UNESCAPED_SLASHES));
    } else {
        $message = "Impossible de lire le contenu du repertoire '$directory'";
        echo '{"code": 1, "message": "' . $message . '"}';
    }
?>
