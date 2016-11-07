<?php
define('COMMENTS_FILE','data/comments.txt');
if (!file_exists(COMMENTS_FILE)){
    $file=fopen(COMMENTS_FILE,'w');
    fclose($file);
}
if(requestIsPost()){
   // if($_POST['button']=='Go'){
//$validRes=$_POST['username']!=''&&$_POST['email']!=''&&$_POST['message']!='';
        if(formIsValid()){
            $comment=$_POST;
            $comment['id'] = uniqid();
            $comment['datetime']=date('Y-m-d H:i:s');
            $comment['rating'] = 0;
            $comment['publish_email']=ifPublish();
            $comment=json_encode($comment);
            file_put_contents(COMMENTS_FILE,$comment.PHP_EOL, FILE_APPEND);
            //вставляем заголовок  ответа к существующим
//        //тут мы перенаправляемся в начало загрузки для обновления формы
//
//        header("Location: /function/ind.php?flashMsg=ok");
//        //тут отправлякм перенаправление и скрипт завершается
//        die();
            setFlash('Comment added');
            redirect('/index.php?page=comments');
        }

        setFlash("Fill the form correctly");

}

if (get('action') == 'update_rating') {
    $updateID = get('id');
    if(get('rating') == "increase"){
        updateRating($updateID, 1);
    }
    elseif(get('rating') == "decrease"){
        updateRating($updateID, -1);
    }
    //setFlash('Rating updated');
    redirect('/index.php?page=comments');
}
if(get('action') == 'delete'){
    $delete_id = get("id");
    deleteComment($delete_id);
    setFlash('Comment deleted');
    redirect('/index.php?page=comments');
}


//$commentsRaw=file(COMMENTS_FILE);
//$comments=[];
//foreach ($commentsRaw as $com){
//    $comments[]=unserialize($com);
//}



$comments=loadComments();
moderate($comments);
$user=isset($_SESSION['user']) ? $_SESSION['user']:"guest";
//print_r($_POST);
?>


<div>
    <h1>Comments</h1>
    <?php if (isset($_COOKIE['username'])) echo 'ура'; else echo '(((';?>

</div>

<form method="post">
    <div class="form-group">
        <label for="username">Name:</label>
        <input type='text' class="form-control" name='username' id="username" value='<?=post('username',$user)?>'>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type='email' class="form-control" name='email' id="email" value="<?=post('email')?>">
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name='message' class="form-control" id='message'><?=post('message')?></textarea>
    </div>
    <div class="checkbox">
        <label>

            <input type='checkbox' id='publish' name='publish'> Publish email?
        </label>
    </div>
    <img src="captcha.php" alt="">
    <input type="text" name="captcha">
    <br><br>

    <button type="submit" class="btn btn-default" value="Go" name="button">Go</button>
</form>

<hr>
<!--comments here...-->
<div class="comment">
    <?php foreach ($comments as $com):?>
    <form action="" method="post" id="delete">
        <b><?=$com['username']?></b> <?=$com['datetime']. " Рейтинг: " . $com['rating'] . " "?>
        <a href="?page=comments&action=update_rating&amp;rating=increase&amp;id=<?=$com["id"]?>">+</a>/
        <a href="?page=comments&action=update_rating&amp;rating=decrease&amp;id=<?=$com["id"]?>">-</a><br>
        <?=$com['publish_email']?$com['email']:''; ?>
        <br> <?=$com['message']?><br>
        <a class="btn btn-default" href="?page=comments&action=delete&amp;id=<?=$com["id"]?>">Delete</a>
        <br><br>
        <?php endforeach;?>
</div>
</form><br>


