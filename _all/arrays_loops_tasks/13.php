<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

        .book
        {
            display: inline-table;
            width: 20%;
            background: rgba(0, 0, 214, 0.11);
            margin-bottom: 5px;
        }
        td
        {
            width:30px;
            height:30px;
            text-align: center;
            vertical-align: middle
        }
        td.red
        {
            background: rgba(255, 156, 139, 0.93);
        }
        td.blue
        {
            background: rgba(154, 176, 255, 0.93);
        }

    </style>
</head>
<body>

<h1>Таблица умножения</h1>
<table>
    <?php
    $numbers = range(1,9);
    foreach ($numbers as $number1) {
        echo '<tr>';
        foreach ($numbers as $number2) {

            $res = $number1 * $number2;
            if($res%2==0){
                echo '<td class="red">';
            }
            else{
                echo '<td class="blue">';
            }

            echo $res . ' ';
            echo '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>

</body>
</html>
