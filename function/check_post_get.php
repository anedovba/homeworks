<?php
function post($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
}
function get ($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : null;
}

function noNotice($func_name, $key){
    return $func_name ($key);
}

