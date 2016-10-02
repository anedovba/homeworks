<?php
$num1=$_POST['num1'];
$num2=$_POST['num2'];
echo "Четные числа от $num1 до $num2 <br>";

if (!($num1%2)){
    for (;$num1<$num2+1;$num1+=2){
        echo $num1."<br>";
    }
}
else {

    for ($num1++;$num1<$num2+1;$num1+=2){
        echo $num1."<br>";
    }
}