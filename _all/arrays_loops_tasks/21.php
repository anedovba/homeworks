<?php
$n=$_POST['num1'];
echo "пирамида из $n рядов и цифр"."<br>";
$i=1;
$row="";

while ($i<=$n){
    $row="";
    for($j=0;$j<$i;$j++){
        $row.="$i";
    }
    $i++;
    echo  $row,"<br>";
}
