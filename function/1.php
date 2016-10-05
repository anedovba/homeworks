<form method='post'>
    <textarea name='a' placeholder='Enter value...'></textarea> <br>
    <textarea name='b' placeholder='Enter value...'></textarea> <br>
    <button name="submit">Go</button>
</form>
<?php
include 'check_post_get.php';
$a=explode(' ',noNotice('post', 'a'));
$b=explode(' ',noNotice('post','b'));
if($_POST){


function getCommonWords($a, $b){
    return array_intersect($a,$b);
}

print_r(getCommonWords($a,$b));}
