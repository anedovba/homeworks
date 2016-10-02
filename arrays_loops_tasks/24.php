<?php
$number=$copy='442158755745656545865523';
$sum=0;
$nnn='5';

for ($i=0;$i<strlen($number);$i++)

{
    if ($number[$i]==$nnn){
        $sum++;

    }
    echo $number[$i],'<br>';
}
echo  "Количество цифр $nnn в числе $copy = $sum";
