<?php

declare(strict_types=1);

error_reporting(0);
ini_set('display_errors', '0');

$theme = isset($_GET["theme"]) && $_GET["theme"] === "light" ? "light" : "dark";
$url = $theme === "light" 
    ? "https://raw.githubusercontent.com/MaiLuong1906/Mailuong1906/output/github-contribution-grid-snake.svg"
    : "https://raw.githubusercontent.com/MaiLuong1906/Mailuong1906/output/github-contribution-grid-snake-dark.svg";

// Cache duration: default 2 hours (7200 seconds), or check query parameter or environment variable
$cacheSeconds = 7200;
if (isset($_SERVER["CACHE_SECONDS"])) {
    $cacheSeconds = intval($_SERVER["CACHE_SECONDS"]);
} elseif (isset($_ENV["CACHE_SECONDS"])) {
    $cacheSeconds = intval($_ENV["CACHE_SECONDS"]);
}
if (isset($_GET["cache_seconds"])) {
    $cacheSeconds = intval($_GET["cache_seconds"]);
}

header("Content-Type: image/svg+xml");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + $cacheSeconds) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: public, max-age=$cacheSeconds");

$svg = file_get_contents($url);
if ($svg === false) {
    http_response_code(500);
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="30"><text x="10" y="20" fill="red">SVG Load Failed</text></svg>';
    exit();
}

echo $svg;
