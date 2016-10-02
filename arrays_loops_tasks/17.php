<?php
echo "<pre>";
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$month = date('M');
print_r($months);
foreach ($months as $item) {
    if ($item == $month) {
        $item = "<b>{$item}</b>";
    }

    echo "{$item} <br>";
}
