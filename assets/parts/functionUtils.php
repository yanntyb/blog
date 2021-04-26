<?php
function sanitize($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);

    return $data;
}

function printR($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}