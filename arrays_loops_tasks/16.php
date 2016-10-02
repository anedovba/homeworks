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

echo "<br>";

foreach ($arr as $key=>$item){
    if(($key+1)%3){
       echo $item.', ';
    }else{
        echo $item.'<br>';
    }
}