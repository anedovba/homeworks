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
    $arr = explode(' ', $fileText);
    $arr2=[];

    foreach ($arr as $v) {

        if (strlen($v) < $num) {

            $arr2[]=$v;
        }
    }
    //print_r($arr2);
    file_put_contents('file.txt',implode(" ", $arr2));
    echo "Файл перезаписан, слова с длиной больше $num символов удалены";
}
words($fileText,$num);
//echo $fileText=file_get_contents('file.txt');

