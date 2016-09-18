<?php
$a=1;
$b=0;
$operator='/';
switch ($operator){
    case '+':
        echo $a+$b;
        break;
    case '-':
        echo $a-$b;
        break;
    case '*':
        echo $a*$b;
        break;
    case '/';
        if($b==0){
            echo 'делить на 0 нельзя';
        }else{
            echo $a/$b;
        }
}