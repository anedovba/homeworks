<?php
function post($key, $default=null)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
function get ($key, $default=null)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function noNotice($func_name, $key){
    return $func_name ($key);
}

