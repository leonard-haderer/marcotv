<?php

    /**
     * Prepare the response in a format readable for marcotv box
     */
    function prepareResponse($code, $message, $content) {
        return $code . "|" . $message . "|" . $content;
    }

    /* --------------- MAIN --------------- */

    $directory = "../choices/";

    $code = 0;
    $message = "OK";

    $user = ($_GET && array_key_exists("user", $_GET)) ? $_GET["user"] : "";
    if ($user == "") {
        $code = 1;
        $message = "Field 'user' is missing.";
        echo(prepareResponse($code, $message, ""));
        exit;
    }

    $file = $directory . $user . ".txt";
    if (!file_exists($file)) {
        $code = 1;
        $message = "No choice found for user '$user'.";
        echo(prepareResponse($code, $message, ""));
        exit;
    }
    
    $movie = file_get_contents($file);
    $delay = time() - filemtime($file);
    if ($delay > 3600) {
        $code = 1;
        $message = "Choice '$movie' is too old. ($delay seconds)";
        echo(prepareResponse($code, $message, ""));
        exit;
    }

    echo(prepareResponse($code, $message, $movie));
?>
