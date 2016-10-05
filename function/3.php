<form method='post'>
    <textarea name='a' placeholder='Enter max number ...'></textarea> <br>
    <button>Go</button>
</form>
<?php
include 'check_post_get.php';
$num=(int)noNotice('post', 'a');
$fileText=file_get_contents('file.txt');

function words($fileText, $num)
{
    $arr = (explode(' ', $fileText));
    foreach ($arr as $k => $v) {
        if (mb_strlen($v,'UTF-8') > $num) {
            unset($arr[$k]);
        }
    }
    //print_r($arr);
    file_put_contents('new_file.txt', implode(' ',$arr));
    echo "Файл перезаписан, слова с длиной больше $num символов удалены";
}
if($_POST){
words($fileText,$num);
}
