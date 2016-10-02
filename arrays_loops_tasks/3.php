<?php
$str_arr=$_POST['array'];
$arr=[];
$tok=strtok($str_arr,", ");
while ($tok){
    $arr[]=$tok;
    $tok=strtok(", ");
}
$result=0;
foreach ($arr as $value){
    $result+=$value*$value;
}
echo "<pre>";
print_r($arr);
echo "Сумма квадратов элементов массива = ",$result;