<form method='post'>
    <textarea name='a' placeholder='Enter value...'></textarea> <br>
    <button>Go</button>
</form>
<?php
include 'check_post_get.php';

$a=explode(' ',noNotice('post', 'a'));

function top3($a){

    foreach ($a as $key => $item){
       $item=strlen($item);

    }
    arsort($a);
    $temp[]=reset($a);
    $temp[]=next($a);
    $temp[]=next($a);



    return $temp;
}

print_r(top3($a));
