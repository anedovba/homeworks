<?php
$day=10;
switch ($day){
    case is_string($day):
        echo "Неизвестный день";
        break;
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo "Это рабочий день";
        break;
    case 6:
    case 7:
        echo "Это выходной день";
        break;
    case is_string($day):
    default:
        echo "Неизвестный день";
}

