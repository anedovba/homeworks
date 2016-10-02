<?php
$arr = array('green'=>'зеленый', 'red'=>'красный','blue'=>'голубой');
echo '<pre>';
print_r($arr);
echo '<br>';
echo "Столбец ключей: <br>";
foreach ($arr as $key=>$value){
    echo $key.'<br>';
}
echo "Столбец значений: <br>";
foreach ($arr as $key=>$value){
    echo $value.'<br>';
}