<?php

if ( $_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [] ;
    extract($_POST, EXTR_PREFIX_ALL, "p") ;
    require "validation.php" ;
    if ( empty($error)) {
        require "seperate.php" ;
        require "final.php" ; 
    } else {
        require "addpage.php" ;
    }
}
if ( $_SERVER["REQUEST_METHOD"] == "GET") {
     require "addpage.php" ;
}



