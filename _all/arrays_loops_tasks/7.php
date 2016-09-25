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
echo "Числа от 3 до 10 <br>";

foreach ($arr as $item){
    if ($item>3 && $item<10)
    echo $item, '<br>';
}