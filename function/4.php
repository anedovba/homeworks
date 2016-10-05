<form method='post'>
    <textarea name='a' placeholder='Enter dir ...'></textarea> <br>
    <button>Go</button>
</form>
<?php
include 'check_post_get.php';
include 'my_print.php';

$dir=noNotice('post', 'a');

function cur_dir($dir){
    if($dir==null){
       return scandir(__DIR__);
    }
    return scandir($dir);
}
if($_POST){
    my_print(cur_dir($dir));
}

