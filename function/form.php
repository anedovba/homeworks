<form method='post'>
    <textarea name='value' placeholder='Enter value...'></textarea> <br>
    <button>Go</button>
</form>

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

$value = str_split(post('value'));
function my_filter($item)
{
    $not_good = [',', '.', ';', ':'];
    return !in_array($item, $not_good);
}
$value = array_filter($value, 'my_filter');

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

$test_arr = [
    'dfg' => 'apple',
    34 => [10,9,8],
    'tttt' => 'cherry'
];
my_print_r($test_arr);