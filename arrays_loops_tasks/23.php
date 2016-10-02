<?php
$number = $copy=$_POST['num1'];
$sum=0;


    while ($number) {
        $r = $number % 10;
        $number = (int)($number / 10);
        $sum+=$r;
    }
    echo  "Сумма цифр числа $copy = $sum";

