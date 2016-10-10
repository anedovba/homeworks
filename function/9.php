<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 10.10.2016
 * Time: 18:49
 * Написать функцию, которая переворачивает строку. Было "abcde", должна выдать "edcba".
 * Ввод текста реализовать с помощью формы.
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Первернуть стору</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<h2>Revers</h2>
<form action="" method="post" class="form-group">
    <textarea class="form-control" rows="1" name="comment" placeholder="Enter string"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Go</button>
</form>
<hr>
<?php
include_once ("functions.php");
function revers(&$a){
    if($_POST){
       return $a=strrev($a);
    }
}
$a=noNotice('post', 'comment');
echo revers($a).'<br>';
echo revers($a);


?>
</body>
</html>