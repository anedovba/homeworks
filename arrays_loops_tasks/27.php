<?php

$cols = rand(2,5);
$rows = rand(2,5);

$colors = array('red','yellow','blue','gray','maroon','brown','green');
echo '<table>';
for ($i = 1; $i <= $rows; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= $cols; $j++) {
        $color = rand(0,count($colors)-1);
        $style = "style='background: $colors[$color]'";
        $n=rand(0, 10000);
        echo "<td $style> $n </td>";
    }
    echo '</tr>';
}
echo '</table>';
