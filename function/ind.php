<!doctype html>
<html>
<head>
</head>
<body>

<form method='post'>
    Name: <input name='name'> <br>
    Comment: <textarea name='comment'></textarea><br>
    <button>Go</button>
</form>

<?php
// if form submitted
if ($_POST) {
    //echo "форма отправлена";
//    $data = $_POST;
//    $data['timestamp'] = time();
//    $data = serialize($data);
//    file_put_contents('comments.txt', $data, FILE_APPEND);
}

?>

</body>
</html>