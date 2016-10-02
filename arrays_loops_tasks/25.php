<?php
echo "<pre>";
$arr=[];//создаем массив
$num=rand(2,20);
//наполняем случайными числами
for($i=0;$i<$num; $i++){
   array_push($arr,rand(0,100));
}
print_r($arr);
$max=$min=$arr[0];
$max_id=$min_id=0;
//оптеделяем максимальное и минимальное значение
for($i=1    ;$i<count($arr); $i++){
    if($arr[$i]>$max){
        $max_id=$i;
        $max=$arr[$i];
    }elseif($arr[$i]<$min){
        $min_id=$i;
        $min=$arr[$i];
    }
}

//меняем местами
$temp=$arr[$max_id];
$arr[$max_id]=$arr[$min_id];
$arr[$min_id]=$temp;
print_r($arr);


