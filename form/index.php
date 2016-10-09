<?php
define('COMMENTS_FILE','comments.txt');
include "functions.php";
$flashMsg=get("flashMsg");

if($_POST){
    if($_POST['button']=='Go'){
//$validRes=$_POST['username']!=''&&$_POST['email']!=''&&$_POST['message']!='';
    if(formIsValid()){
        $comment=$_POST;
        $comment['datetime']=date('Y-m-d H:i:s');
        $comment['publish_email']=ifPublish();
        $comment=serialize($comment);
        file_put_contents(COMMENTS_FILE,$comment.PHP_EOL, FILE_APPEND);
        //вставляем заголовок  ответа к существующим
//        //тут мы перенаправляемся в начало загрузки для обновления формы
//
//        header("Location: /function/ind.php?flashMsg=ok");
//        //тут отправлякм перенаправление и скрипт завершается
//        die();
        redirect('?flashMsg=ok');
    }

    $flashMsg="заполни всю форму";
}
elseif ($_POST['button']=='Delete'){
if(ifDelete()){
    $comments=loadComments();
    deleteCom($comments, $_POST['delPost']);
    echo "удалить!!!";}
    else{
        echo "не удалаять!!!";
    }
}
}


//$commentsRaw=file(COMMENTS_FILE);
//$comments=[];
//foreach ($commentsRaw as $com){
//    $comments[]=unserialize($com);
//}
$comments=loadComments();
moderate($comments);
//print_r($_POST);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Comments</h1>
<div>
    <h4><?=$flashMsg?></h4>
    <br>
</div>


<?php
require "layout.php";
?>

<hr>
<!--comments here...-->
<div class="comment">
    <?php foreach ($comments as $com):?>
    <form action="" method="post" id="delete">
        <b><?=$com['username']?></b> <label for="delPost"><?=$com['datetime']?></label>  <?=$com['publish_email']?$com['email']:''; ?>
            <br> <?=$com['message']?><br>

            <input type='checkbox' id='delPost' name='delPost'> Delete post?<br>


    <?php endforeach;?>

</div>
<button type="submit" value="Delete" name="button">Delete</button>
</form><br>


<?php
// if form submitted
//if ($_POST) {
//    //echo "форма отправлена";
//    $data = $_POST;
//    $data['timestamp'] = time();
//    $data = serialize($data);
//    file_put_contents('comments.txt', $data, FILE_APPEND);
//}

?>

</body>
</html>
<!--todo - сделать чекбокс для согласия юзера опубликовать имейл, оформить сss через bootstrap, // done-->
