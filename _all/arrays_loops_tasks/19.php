<?php
echo "<pre>";
$week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$day=date('l');
print_r($week);
foreach ($week as $item) {
    if ($item == $day) {
        $item = "<b>{$item}</b>";
    }

    echo "{$item} <br>";
}
