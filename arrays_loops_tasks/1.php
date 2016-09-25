<h1>элементы массива в столбик:</h1>
<?php
$str_arr=$_POST['array'];
$arr=[];
$tok=strtok($str_arr,", ");
while ($tok){
    $arr[]=$tok;
    $tok=strtok(", ");
}
foreach ($arr as $value){
    echo $value, '<br>';

}