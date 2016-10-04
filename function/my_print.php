<?php
function my_print(array $a, $die = false)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';

    if ($die) {
        die;
    }
}