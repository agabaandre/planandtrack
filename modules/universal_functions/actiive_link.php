<?php
function activelink($link, $uri_segment)
{

    $flink = $link . '.php';

    if ($uri_segment[3] == $flink) {
        return "active";
    } else {
        return $flink;
    }
}

function uri_segment()
{

    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    return $uri_segments;
}
