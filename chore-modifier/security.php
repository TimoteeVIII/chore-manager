<?php

function h($str){ // returns string with characters of special significace in html represented by HTML entites
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); 
}
?>