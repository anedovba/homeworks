<?php
$str="([[SJDHKJAS];;;S]KCKC())0()";
$arr_brack = array('(', ')', '[', ']');

$str_brack = '';
for($i = 0, $len = strlen($str); $i < $len; $i++)
{
    //переносим все скобки в новую строку
    if(in_array($str[$i], $arr_brack))
        $str_brack .= $str[$i];
}

//чистим строку
for($i = 0, $len = strlen($str_brack); $i < $len; $i++)
    $str_brack = str_replace(array('[]', '()'), array('', ''), $str_brack);

if(strlen($str_brack) == 0)
    echo " все скобки закрыты";
else
    echo " не все скобки закрыты";
