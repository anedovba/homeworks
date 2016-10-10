<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 10.10.2016
 * Time: 19:05
 * Написать функцию, которая считает количество уникальных слов в тексте. Слова разделяются пробелами.
 * Текст должен вводиться с формы.
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Количество уникальных слов</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<h2>Words count</h2>
<form action="" method="post" class="form-group">
    <textarea class="form-control" rows="1" name="comment" placeholder="Enter string"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Go</button>
</form>
<hr>
<?php
include_once ("functions.php");

function unique($a){
    if($_POST){
        $b=array_unique(explode(' ',mb_strtolower($a)));
        echo 'Всего уникальных слов - '.count($b);
    }
}
$a=noNotice('post', 'comment');
unique($a);
?>
</body>
</html>