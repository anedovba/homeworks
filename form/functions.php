<?php

function dd($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}
function post($key, $default=null)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
function get ($key, $default=null)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function noNotice($func_name, $key){
    return $func_name ($key);
}

function formIsValid(){
    return post('username')!=''&&post('email')!=''&&post('message')!='';
}

function redirect($to){
    header("Location: ".$to);
    die;
}
function loadComments($file = COMMENTS_FILE)
{
    $commentsRaw = file($file);
    $comments = [];

    foreach ($commentsRaw as $comment) {
        $comments[] = unserialize($comment);
    }

    return $comments;
}

function ifPublish()
{
    return (int) (post('publish')!==null);
}
function ifDelete()
{
    return (int) (post('delPost')!==null);
}

function replase(&$item1, $key, array $badWords)
{
    foreach ($badWords as $k =>$w){
        if (mb_strlen($badWords[$k]) <= 2) {
            $item1['message'] = str_replace($badWords[$k], '**', $item1['message']);

        } elseif(mb_strlen($badWords[$k])==3) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1), '**', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==4) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,2), '**', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==5) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,3), '***', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==6) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,4), '****', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==7) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,5), '*****', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==8) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,6), '******', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==9) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,7), '*******', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==10) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,8), '********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==11) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,9), '*********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==12) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,10), '**********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==13) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,11), '***********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==14) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,12), '************', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==15) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,13), '*************', $item1['message']);
            }
    }
}
function moderate(array &$comments){ //&$comments- изменит саму переменную
    //todo - использовать array_walk() вместо форич //done
    // Todo as - ** beach - b***h // done
   //$badWords=file('badwords.txt');

   $badWords = ['ass', 'bitch', 'smuck', 'fu'];
   // dd($badWords);
    array_walk($comments,'replase', $badWords);
//    foreach ($comments as &$com){
//       $com['message']=str_replace($badWords, '***', $com['message']);
//    }
}
function deleteCom(array &$comments, $date ){
    dd($comments);

}