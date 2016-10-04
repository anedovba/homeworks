<?php
function my_print_r(array $array)
{
    echo 'Array ( ';

    foreach ($array as $key => $value) {
        echo "[$key] => ";
        if (is_array($value)) {
            my_print_r($value);
        } else {
            $type = gettype($value);
            echo "$type($value) ";
        }
    }

    echo ' ) ';
}

// my_print_r без foreach

function my_print_rc(array $array)
{
    static $i='Array ( ';
    echo $i;
    $key=key($array);
    echo "[$key] => ";
    $value=$array[$key];
    if (is_array($value)) {
        $i='Array ( ';
        my_print_rc($value);

    } else {
        $type = gettype($value);
        echo "$type($value) ";
    }
    if(next($array)){
        $i='';
        my_print_rc($array);
    }
    else{
        echo ' ) ';
    }

}

$test_arr = [
    'dfg' => 'apple',
    34 => [10,9,8],
    'tttt' => 'cherry'
];

//my_print простой

function my_print(array $a, $die = false)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';

    if ($die) {
        die;
    }
}
my_print_r($test_arr);
echo "<hr>";
my_print_rc($test_arr);