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
$flag=false;
foreach ($arr as $e){
    if ($e==2 || $e==3 || $e==4){
        $flag=true;
        break;
    }
}
if($flag){
    echo $e. ' В массиве есть элемент со значением равным 2,3 или 4';
} else{
echo 'В массиве нет элементов со значением равным 2,3 или 4';
    }


