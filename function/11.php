<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 10.10.2016
 * Time: 20:13
 * Написать функцию, которая в качестве аргумента принимает строку, и форматирует ее таким образом,
 * что каждое новое предложение начиняется с большой буквы.<br>
 * Пример:
 * Входная строка: 'а васька слушает да ест. а воз и ныне там. а вы друзья как ни садитесь, все в музыканты не годитесь.
 * а король-то — голый. а ларчик просто открывался.а там хоть трава не расти.';
 * Строка, возвращенная функцией :  'А Васька слушает да ест. А воз и ныне там. А вы друзья как ни садитесь, все в музыканты не годитесь.
 * А король-то — голый. А ларчик просто открывался.А там хоть трава не расти.';
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <title>Форматирование предложения</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<h2>Format new sentence</h2>
<form action="" method="post" class="form-group">
    <textarea class="form-control" rows="1" name="comment" placeholder="Enter string"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Go</button>
</form>
<hr>
<?php
include_once ("functions.php");
function mb_ucfirst($str, $encoding='UTF-8')
{
    $str = mb_ereg_replace('^[\ ]+', '', $str);
    $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
        mb_substr($str, 1, mb_strlen($str), $encoding);
    return $str;
}
function newSentence($a){
    if($_POST){
        $a=explode(".", $a);
        $b=[];
        foreach ($a as $sentence){
            $b[]= mb_ucfirst($sentence);
        }
        //dd($b);
        return implode(". ", $b);
    }
}
$a=noNotice('post', 'comment');
echo $a=newSentence($a);
?>
</body>
</html>