<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 10.10.2016
 * Time: 21:54
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <title>Форматирование предложения</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<h2>words count</h2>
<form action="" method="post" class="form-group">
    <textarea class="form-control" rows="1" name="comment" placeholder="Enter string"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Go</button>
</form>
<hr>
<?php
include_once ("functions.php");

function countWords($a){
    if($_POST){
        $b=array_unique(explode(" ", $a));
        $c=[];
        foreach ($b as $value){
            $c["$value"]=substr_count($a, $value);
        }
        arsort($c);
        foreach ($c as $key => $value){
            echo $key." - ".$value."<br>";
        }
    }
}
$a=noNotice('post', 'comment');
countWords($a);
?>
</body>
</html>