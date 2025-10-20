<?php
    echo(json_encode($_POST));
    $directory = "../choices";
    $response = array();
    $response["code"] = 0;
    $response["message"] = "OK";
    if (!array_key_exists("user", $_POST)) {
        $response["code"] = 1;
        $response["message"] = "Field 'user' is missing.";
    } else if (!array_key_exists("movie", $_POST)) {
        $response["code"] = 1;
        $response["message"] = "Field 'movie' is missing.";
    } else {
        $user = $_POST["user"];
        $movie = $_POST["movie"];
        file_put_contents($directory . $user . ".txt", $movie);
    }
    echo(json_encode($response, JSON_UNESCAPED_SLASHES));
?>
