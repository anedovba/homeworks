<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задачи по массивам и циклам</title>
</head>
<body>

<h1>Задачи по массивам и циклам</h1>

<p><b>Все задания должны выполняться в папке arrays_loops_tasks, в отдельных файлах, которые должны называться по номеру задания, например, "17.php".<br>
        Если задание требует создания нескольких файлов - то такие файлы необходимо размещать в папке, название которой равно номеру задания.</b>
</p>

<p>
    <b>Вопросы можно задавать на <a href="http://ask.php-academy.kiev.ua/" target="_blank">http://ask.php-academy.kiev.ua/</a>.</b>
</p>

<hr>

<b>Работа с foreach</b>
<p>1. Дан массив с элементами 'html', 'css', 'php', 'js', 'jq'. С помощью цикла foreach выведите эти слова в столбик. <a href="/arrays_loops_tasks/1.html"  target="_blank">Ответ 1</a></p>
<p>2. Дан массив с элементами 1, 20, 15, 17, 24, 35. С помощью цикла foreach найдите сумму элементов этого массива. Запишите ее в переменную $result. <a href="/arrays_loops_tasks/2.html"  target="_blank">2 Ответ </a></p>
<p>3. Дан массив с элементами 26, 17, 136, 12, 79, 15. С помощью цикла foreach найдите сумму квадратов элементов этого массива. Результат запишите переменную $result. <a href="/arrays_loops_tasks/3.html"  target="_blank">3 Ответ</a></p>

<b>Работа с ключами</b>

<p>4. Дан массив $arr. С помощью первого цикла foreach выведите на экран столбец ключей, с
    помощью второго — столбец элементов. <a href="/arrays_loops_tasks/4.php"  target="_blank">4.php</a> </p>
$arr = array('green'=>'зеленый', 'red'=>'красный','blue'=>'голубой');
<p>5. Дан массив $arr с ключами 'Коля', 'Вася', 'Петя' с элементами '200', '300', '400'. С помощью
    цикла foreach выведите на экран столбец строк такого формата: 'Коля — зарплата 200
    долларов.'. <a href="/arrays_loops_tasks/5.php"  target="_blank">5.php</a></p>
<p>6. Дан массив $arr. С помощью цикла foreach запишите английские названия в массив $en, а
    русские — в массив $ru.
    $arr = array('green'=>'зеленый', 'red'=>'красный','blue'=>'голубой');
    $en = array('green', 'red','blue');
    $ru = array('зеленый', 'красный', 'голубой'); <a href="/arrays_loops_tasks/6.php"  target="_blank">6.php</a></p>
<p>7. Дан массив с элементами 2, 5, 9, 15, 0, 4. С помощью цикла foreach и оператора if
    выведите на экран столбец тех элементов массива, которые больше 3­х, но меньше 10. <a href="/arrays_loops_tasks/7.html"  target="_blank">7 ответ</a></p>
<p>8. Дан массив с элементами 1, 2, 3, 4, 5, 6, 7, 8, 9. С помощью цикла foreach создайте строку
    '­1­2­3­4­5­6­7­8­9­'.
    Циклы while и for <a href="/arrays_loops_tasks/8.html"  target="_blank">8 Ответ</a></p>
<p>9. Выведите столбец чисел от 1 до 100.<a href="/arrays_loops_tasks/9.html"  target="_blank">9 ответ</a></p>
<p>10. Выведите столбец чисел от 11 до 33. <a href="/arrays_loops_tasks/9.html"  target="_blank">то же что в 9 ответе</a></p>
<p>11. Выведите столбец четных чисел в промежутке от нуля до 100. <a href="/arrays_loops_tasks/11.html"  target="_blank">11 Ответ</a></p>
<p>12. Дано число $n = 1000. Делите его на 2 столько раз, пока результат деления не станет
    меньше 50. Какое число получится? Посчитайте количество итераций, необходимых для
    этого (итерации — это количество проходов цикла), и запишите его в переменную $num. <a href="/arrays_loops_tasks/12.html"  target="_blank">12 ответ</a></p>
<p>13. Вывести таблицу умножения <a href="/arrays_loops_tasks/13.php"  target="_blank">13.php</a></p>
<p>14. Дан массив с элементами 4, 2, 5, 19, 13, 0, 10. С помощью цикла foreach и оператора if
    проверьте есть ли в массиве элемент со значением $e, равном 2, 3 или 4. Если есть —
    выведите на экран 'Есть!', иначе выведите 'Нет!'. <a href="/arrays_loops_tasks/14.html"  target="_blank">14 ответ</a></p>
<p>15. Дан массив $arr. С помощью цикла foreach и переменной $count подсчитайте количество
    элементов этого массива. Проверьте работу скрипта на примере массива с элементами 4, 2,
    5, 19, 13, 0, 10. <a href="/arrays_loops_tasks/15.html"  target="_blank">15 ответ</a></p>
<p>16. Дан массив с элементами 1, 2, 3, 4, 5, 6, 7, 8, 9. С помощью цикла foreach и оператора if
    выведите на экран столбец элементов массива, как показано на картинке.
    1, 2, 3
    4, 5, 6
    7, 8, 9 <a href="/arrays_loops_tasks/16.html"  target="_blank">16 ответ</a></p>
<p>17.Составьте массив месяцев. С помощью цикла foreach выведите все месяцы, а текущий
    месяц выведите жирным. Текущий месяц должен храниться в переменной $month. <a href="/arrays_loops_tasks/17.php"  target="_blank">17.php</a></p>
<p>18. Составьте массив дней недели. С помощью цикла foreach выведите все дни недели,
    выходные дни следует вывести жирным.<a href="/arrays_loops_tasks/18.php"  target="_blank">18.php</a></p>
<p>19. Составьте массив дней недели. С помощью цикла foreach выведите все дни недели, а
    текущий день выведите курсивом. Текущий день должен храниться в переменной $day.<a href="/arrays_loops_tasks/19.php"  target="_blank">19.php</a></p>
<p>20.Нарисуйте пирамиду, как показано на рисунке, только у вашей пирамиды должно быть 20
    рядов, а не 5.<br><br>
    x<br>
    xx<br>
    xxx<br>
    xxxx<br>
    xxxxx <a href="/arrays_loops_tasks/20.html"  target="_blank">20 ответ</a></p>
<p>21. Нарисуйте пирамиду, как показано на рисунке, только у вашей пирамиды должно быть 9
    рядов, а не 5.<br><br>
    1<br>
    22<br>
    333<br>
    4444<br>
    55555 <a href="/arrays_loops_tasks/21.html"  target="_blank">21 ответ</a></p>
<p>22. Нарисуйте пирамиду, как показано на рисунке, воспользовавшись циклом for или while.<br><br>
    xx<br>
    xxxx<br>
    xxxxxx<br>
    xxxxxxxx<br>
    xxxxxxxxxx <a href="/arrays_loops_tasks/22.html"  target="_blank">22 ответ</a></p>
<p>23. Вам нужно разработать программу, которая считала бы сумму цифр числа введенного
    пользователем. Например: есть число 123, то программа должна вычислить сумму цифр 1,
    2, 3, т. е. 6. <a href="/arrays_loops_tasks/23.html"  target="_blank">23 ответ</a></p>
По желанию можете сделать проверку на корректность введения данных пользователем.
<p>24. Вам нужно разработать программу, которая считала бы количество вхождений
    какой­нибуть выбранной вами цифры в выбранном вами числе. Например: цифра 5 в числе
    442158755745 встречается 4 раза.<a href="/arrays_loops_tasks/24.php"  target="_blank">24.php</a></p>
<p>25. Ваше задание создать массив, наполнить это случайными значениями (функция rand),
    найти максимальное и минимальное значение и поменять их местами.<a href="/arrays_loops_tasks/25.php"  target="_blank">25.php</a></p>
<p>26. Вам нужно создать массив и заполнить его случайными числами от 1 до 100 (ф­я rand).
    Далее, вычислить произведение тех элементов, которые больше ноля и у которых парные
    индексы. После вывести на экран элементы, которые больше ноля и у которых не парный
    индекс.<a href="/arrays_loops_tasks/26.php"  target="_blank">26.php</a></p>
<p>27. Создать генератор случайных таблиц. Есть переменные: $row - кол-во строк в таблице, $cols - кол-во столбцов в таблице. Есть список цветов, в массиве: $colors = array('red','yellow','blue','gray','maroon','brown','green'). Необходимо создать скрипт, который по заданным условиям выведет таблицу размера $rows на $cols, в которой все ячейки будут иметь цвета, выбранные случайным образом из массива $colors. В каждой ячейке должно находиться случайное число. <br><br>

    Пример результата:<br>

<table><tr><td style='background-color:blue'>2033</td><td style='background-color:brown'>11696</td><td style='background-color:green'>712</td><td style='background-color:yellow'>32583</td><td style='background-color:red'>157</td></tr><tr><td style='background-color:gray'>25694</td><td style='background-color:red'>19724</td><td style='background-color:brown'>18487</td><td style='background-color:brown'>8462</td><td style='background-color:red'>4412</td></tr><tr><td style='background-color:gray'>4673</td><td style='background-color:gray'>14450</td><td style='background-color:maroon'>16748</td><td style='background-color:gray'>3505</td><td style='background-color:maroon'>5299</td></tr><tr><td style='background-color:red'>16873</td><td style='background-color:gray'>21370</td><td style='background-color:green'>22482</td><td style='background-color:red'>28576</td><td style='background-color:blue'>26060</td></tr><tr><td style='background-color:yellow'>28955</td><td style='background-color:gray'>8804</td><td style='background-color:gray'>26825</td><td style='background-color:red'>31471</td><td style='background-color:blue'>22283</td></tr></table>
<a href="/arrays_loops_tasks/27.php"  target="_blank">27.php</a>
</p>

<p>28. Вывести таблицу умножения с помощью двух циклов for.<a href="/arrays_loops_tasks/28.php"  target="_blank">28.php</a></p>


<hr>

<p>
    <b>&copy; 2014-2016 <a href="http://php-academy.kiev.ua/" target="_blank">PHP Academy</a></b>
</p>

</body>
</html>