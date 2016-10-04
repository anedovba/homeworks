<?php
function my_print_r(array $a, $die = false)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';

    if ($die) {
        die;
    }
}
function isPrime($number)
{
    if (!is_numeric($number)||$number<=0) {
        die('error');
    }

    // todo: better validation

    if ($number <= 3) {
        return true;
    }

    for ($j = 2; $j < $number; $j++) {
        if ($number % $j == 0) {
            return false;
        }
    }

    return true;
}
if (!isset($_GET['max_number'])) {
    die('error');
}
$max = $_GET['max_number'];
$prime_numbers = [2, 3];
for ($i = 4; $i <= $max; $i++) {
    if (isPrime($i)) {
        $prime_numbers[] = $i;
    }
}
my_print_r($prime_numbers);
