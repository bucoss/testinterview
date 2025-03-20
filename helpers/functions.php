<?php

function dd($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function getUri(){
    return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
}

function isUriEqualTo($value){
    return getUri() == $value;
}