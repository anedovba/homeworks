<?php
echo '<pre>';
$arr = array('green'=>'зеленый', 'red'=>'красный','blue'=>'голубой');

print_r($arr);
$en=$ru=[];

foreach ($arr as $key=>$value){
    $en[]=$key;
    $ru[]=$value;
}
print_r($en);
print_r($ru);