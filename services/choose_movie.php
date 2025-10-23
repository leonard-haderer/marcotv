<?php
    $user = "";
    $movie = "";
    $directory = "../choices/";

    if ($_POST) {
        if (array_key_exists("user", $_POST)) {
            $user = $_POST["user"];
        }
        if (array_key_exists("movie", $_POST)) {
            $movie = $_POST["movie"];
        }
    }
    if ($_GET) {
        if (array_key_exists("user", $_GET)) {
            $user = $_GET["user"];
        }
        if (array_key_exists("movie", $_GET)) {
            $movie = $_GET["movie"];
        }
    }

    $response = array();
    $response["code"] = 0;
    $response["message"] = "OK";
    if ($user == "") {
        $response["code"] = 1;
        $response["message"] = "Field 'user' is missing.";
    } else if ($movie == "") {
        $response["code"] = 1;
        $response["message"] = "Field 'movie' is missing.";
    } else {
        $file = $directory . $user . ".txt";
        if (file_exists($file)) {
            unlink($file);
        }
        file_put_contents($file, $movie);
    }
    echo(json_encode($response, JSON_UNESCAPED_SLASHES));
?>
