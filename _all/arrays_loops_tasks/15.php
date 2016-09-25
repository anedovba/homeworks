<?php
echo "<pre>";
$str_arr=$_POST['array'];
$arr=[];
$tok=strtok($str_arr,", ");
while ($tok){
    $arr[]=$tok;
    $tok=strtok(", ");
}
print_r($arr);

$count=0;
foreach ($arr as $item){
    $count++;
}
echo "Количество элементов в массиве = $count";