<?php
$num1=$_POST['num1'];
$num2=$_POST['num2'];
echo "числа от $num1 до $num2 <br>";
for ($i=$num1;$i<$num2+1;$i++){
    echo $i."<br>";
}