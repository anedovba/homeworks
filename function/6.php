<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form enctype="multipart/form-data" method="post">
    <p>
    <p>Загрузите ваши фотографии</p>

    <input type="file" name="photo[]" multiple accept="image/*,image/jpeg"> <br><br>
    <input type="submit" name="submit" value="Отправить">
    </p>
    <hr>
</form>

<?php
if(is_dir('gallery')==false){
    mkdir('gallery');
    //echo "create dir ok <br>";
}
if($_POST){
//echo "post ok <br>";//отладка

   // echo "dir gallery ok <br>";//отладка

   ////загрузка одного файла
//    $dir = 'gallery/';
//    $file = $dir . basename($_FILES['photo']['name']);
//
//    echo '<pre>';
//    if (move_uploaded_file($_FILES['photo']['tmp_name'], $file)) {
//        echo "Файл корректен и был успешно загружен.\n";
//    } else {
//        echo "Возможная атака с помощью файловой загрузки!\n";
//    }
//
//    echo 'Некоторая отладочная информация:';
//    print_r($_FILES);
//
//    print "</pre>";

    ////загрузка нескольких  файлов
    foreach ($_FILES["photo"]["error"] as $key => $error) {
       // echo "enter file ok <br>";
        if ($error == UPLOAD_ERR_OK) {
            //echo "файл сохраняется <br>";
            $tmp_name = $_FILES["photo"]["tmp_name"][$key];
            // basename() может спасти от атак на файловую систему;
            // может понадобиться дополнительная проверка/очистка имени файла
            $name = basename($_FILES["photo"]["name"][$key]);
            move_uploaded_file($tmp_name,'gallery/'.$name);
            //echo "файл сохранился <br>";
        }
    }
}
$filename = 'gallery/';
    $files=scandir($filename);?>
        <table>
            <?php
            foreach ($files as $value){
                if($value=='.'||$value=='..'){
                    continue;
                }?>
            <tr>
                <td>
                <img src="<?='gallery/'.$value;?>">
                </td>
            </tr>
                <?php  }
    ?>

</table>
</body>
</html>


