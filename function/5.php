<form method='post'>
    <textarea name='a' placeholder='Enter dir ...'></textarea> <br>
    <textarea name='b' placeholder='Search:'></textarea> <br>
    <button>Go</button>
</form>
<?php
include 'check_post_get.php';
include 'my_print.php';
$dir=noNotice('post', 'a');
$word=noNotice('post', 'b');

function find_file($dir, $word){
    if($dir==null){
        $arr=(scandir(__DIR__));
    }else
    $arr=(scandir($dir));
    $res=[];
    if($word==null){
        $res[]="Введите слово для поиска";
        return $res;
    }

    foreach ($arr as $value){
        $temp=strpos($value,$word);

        if($temp!==false){
            $res[]=$value;
        }
    }
    if($res==null){
        $res[]="Такой файл не найден";
    }
    return $res;
}

if ($_POST){
    my_print(find_file($dir,$word));
}

