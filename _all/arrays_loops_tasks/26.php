<?php
echo "<pre>";
$arr=[];//создаем массив
$num=rand(2,7);
//наполняем случайными числами
for($i=0;$i<$num; $i++){
    array_push($arr,rand(1,100));
}
print_r($arr);
$m=1;
$arr2=[];
foreach ($arr as $key=>$item){
    if(($item>0)&&!($key%2)&&$key){
       $m*=$item;
    }elseif(($item>0)&&($key%2)){
        $arr2[]=$item;
    }
}

if($m==1)$m=0;
echo "произведение тех элементов, которые больше ноля и у которых парные индексы = $m <br>";

echo 'элементы, которые больше ноля и у которых не парный индекс ';
foreach ($arr2 as $item){
    echo $item,' ';
}