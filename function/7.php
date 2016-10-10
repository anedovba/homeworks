<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 10.10.2016
 * Time: 15:42
 * Создать гостевую книгу, где любой человек может оставить комментарий в текстовом поле и добавить его.
 * Все добавленные комментарии выводятся над текстовым полем. Реализовать проверку на наличие в тексте запрещенных слов, матов.
 * При наличии таких слов - выводить сообщение "Некорректный комментарий".
 */
include "functions.php";
define('COMMENTS_FILE','reviews.txt');
$i=1;
if(is_file(COMMENTS_FILE)){
    $comments=loadComments();
    foreach ($comments as $key => $item) {
        echo "<p>$i: <em>{$item['comment']}</em></p>";
        $i++;
    }
}
if ($_POST) {
    $comment=$_POST;
    $comment=serialize($comment);
    $badWords = ['ass', 'bitch', 'smuck', 'fu'];
    $flag=false;
    foreach ($badWords as $word){
        if(mb_strpos($comment, $word)){
            echo "<h3>Некорректный комментарий!</h3>";
            $flag=true;
        }
    }
    if(!$flag){
        file_put_contents(COMMENTS_FILE,$comment.PHP_EOL, FILE_APPEND);
        $comment=unserialize($comment);
        echo "<p>$i: <em>{$comment['comment']} </em></p>";
        $i++;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Отзывы</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<h2>Comments</h2>
<form action="" method="post" class="form-group">
    <textarea class="form-control" rows="3" name="comment" placeholder="Enter comment"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Go</button>
</form>
</body>
</html>