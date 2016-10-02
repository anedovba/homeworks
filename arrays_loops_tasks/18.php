<?php
echo "<pre>";
$week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

print_r($week);
foreach ($week as $item) {
    if ($item == 'Saturday'||$item == 'Sunday') {
        $item = "<b>{$item}</b>";
    }

    echo "{$item} <br>";
}
