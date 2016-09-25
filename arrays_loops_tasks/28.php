<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Таблица умножения</h1>
<table style="border-spacing: 10px">
    <?php
    $numbers = range(1,9);
    for ($i=0; $i<count($numbers);$i++){
        echo '<tr>';
        for ($j=0; $j<count($numbers);$j++){
            $res = $numbers[$i] * $numbers[$j];
            echo '<td style="height:40px;width: 70px;">';
            echo $numbers[$i].' * '. $numbers[$j].' = '.'<b>'.$res.'</b>' . ' ';
            echo '</td>';
        }
    }
    ?>
</table>

</body>
</html>