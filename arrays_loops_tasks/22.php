<?php
$n=$_POST['num1'];
echo "пирамида из $n рядов"."<br>";
$i=1;
$row="";
while ($i<=$n){
    echo $row.="xx", '<br>';
    $i++;
}
