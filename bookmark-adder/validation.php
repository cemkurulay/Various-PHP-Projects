<?php

$urlPattern = '/^(http(s)?):\/\/[a-z0-9]+(\.[a-z0-9]+){1,3}$/' ;
if ( preg_match($urlPattern, $p_url)) {
    $protocoll = preg_replace('/^(http(s)?):\/\/[a-z0-9]+(\.[a-z0-9]+){1,3}$/', '\1', $p_url);
    $domainn = preg_replace('/^(http(s)?):\/\/([a-z0-9]+(\.[a-z0-9]+){1,3})$/', '\3', $p_url);
} else{
    $error[] = "url" ;
}

if ( strlen(trim($p_title)) == 0) {
    $error[] = "title" ;
}