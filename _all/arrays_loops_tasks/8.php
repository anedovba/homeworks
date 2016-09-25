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
$str='-';
foreach ($arr as $item){
    $str=$str."{$item}-";
}
echo "$str";