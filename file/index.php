<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 11.10.2016
 * Time: 19:09
 */

//todo:
// 1 ограничение на размер проверка типов фото - готово
//2 динамически изменить размер файла - нет
//3 удаление проверить наличие файла - готово
//4 создать альбом - в каждом альбоме свои картинки - нет

//5 к каждой картинке заголовок - готово

//6 при добавлении добавить сообщение - добавлено  - готово



//modes w - создает/пересоздает файл и разрешает записывать/перезаписать, r - читать с файла, a, w+,r+,a+

//$file=fopen('data.txt','w');
//fwrite($file,'Hello ');
//fwrite($file,'world');
//
//
//$file=fopen('data.txt','r');
//echo ftell($file).'<br>';//позиция маркера
//echo filesize('data.txt').'<br>';//размер файла
//echo fread($file,2).'<br>';
//echo ftell($file).'<br>';
//echo fread($file,filesize('data.txt')).'<br>';
//
//fseek($file,1);//перемещает маркер

//$file=fopen("data.txt", "a");//дозапись
//fwrite($file,PHP_EOL.'Wow');
//fclose($file);
////удалить файл
//unlink('data.txt');
////
////проверка наличия файла директории
//file_exists('data.txt');
//
////показать каталог
//$arr=scandir('../');//на директорию выше
//is_file();
//is_dir();
//mkdir();
//rmdir();

//ЗАГРУЗКА ОДНОГО ФАЙЛА
//require '../function/functions.php';
//if(isset($_FILES['attachment'])){
//    $file=$_FILES['attachment'];
//    if(!$file['error']){//ЕСЛИ НЕТ ОШИБКИ
//          //ПЕРЕМЕЩАЕМ ЗАГРУЖЕННЫЙ НАШ ФАЙЛ ИЗ ВРЕМЕННОЙ ДИРЕКТОРИИ В НУЖНУЮ ДИРЕКТОРИЮ
//        move_uploaded_file($file['tmp_name'],
//                                  'uploads'.DIRECTORY_SEPARATOR.$file['name']);
//    }
//}

//        if ($file['error']) {
//            die ('Error');
//        }
//        if($file['type']!='image/jpeg'){//ЕСЛИ ТИП НЕ КАРТИНКА
//            die('Not a jpeg image');
//        }
//
//        $filename=md5(uniqid());//алгоритм создания случайного имени
//        $extention=explode('.',file(['name']));//ДОБАВЛЯЕМ РАСШИРЕНИЕ
//        $extention=end($extention);
//        //New file name
//        $filename.='.'.$extention;
//
//        $move_result=move_uploaded_file($file['tmp_name'],
//            'uploads/'.$filename);
//        if(!$move_result){
//            die('move upload fail');
//        }

require '../comments_form/functions.php';


if (!file_exists('uploads')) {
    mkdir('uploads');
}


function reArrayFiles(&$file_post) { //переформатирование загружаемого массива файлов

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


function fileHasNoError(array $file)//проверка ошибок
{
    return !$file['error'];
}


function fileIsJpeg(array $file)
{
    return $file['type'] == 'image/jpeg';
}

function fileIsOfTypes(array $file, array $types)//проверка типа файла
{

    return in_array($file['type'], $types);
}

function fileIsLessThan($file, $size)//проверка на размер
{
   return (bool)($file['size']<=$size);
}

function changeSize(array $file){//не работает
    // файл

// задание максимальной ширины и высоты
    $width = 200;
    $height = 200;

// тип содержимого
    header('Content-Type: image/jpeg');

// получение новых размеров
    list($width_orig, $height_orig) = getimagesize($file['name']);

    $ratio_orig = $width_orig/$height_orig;

    if ($width/$height > $ratio_orig) {
        $width = $height*$ratio_orig;
    } else {
        $height = $width/$ratio_orig;
    }

// ресэмплирование
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($file['name']);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
$file=$image_p;
// вывод
    return imagejpeg($image_p, $file['name'], 100);
}
if (requestIsPost()) {
    if (isset($_FILES['attachment'])) {
        $files = $_FILES['attachment'];
        $files = reArrayFiles($files);

        foreach ($files as &$file) {

            if (!fileHasNoError($file)) {
                $er=$file['error'];
                redirect("/file?msg=error type $er");
                continue;
            }
               $types=['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/svg+xml', 'image/tiff', 'image/vnd.microsoft.icon', 'image/vnd.wap.wbmp', 'image/webp'];
            if (!fileIsOfTypes($file,$types)) {
            redirect("/file?msg=error wrong type");
                continue;
            }

            if(!fileIsLessThan($file,30000)){
                //changeSize(&$file);
                redirect("/file?msg=error size is too big");
                continue;
            }


            $filename = uniqid();
            $extension = explode('.', $file['name']);
            $extension = end($extension);
            // new full filename
            $filename .= ".$extension";

            $move_result = move_uploaded_file(
                $file['tmp_name'],
                'uploads/' . $filename
            );

            if (!$move_result) {
                header('HTTP/1.1 500 Internal Server Error');
                continue;
            }

        }

       redirect('/file?msg=files were uploaded');
    }
}

if (get('action') == 'delete') {
    if (!file_exists('file')) {
        unlink('uploads/' . get('file'));
    }

}


$files = scandir('uploads');
array_shift($files);//УДАЛЯЕМ '.' И '..' В МАССИВЕ ДИРЕКТОРИЙ
array_shift($files);
?>

<!doctype html>
<html>
<head>
    <title>Gallery</title>
</head>
<body>
<h2>Gallery</h2>

<hr>

<form 	action="" method='post'
         enctype="multipart/form-data">

    <input type="file" name="attachment[]" multiple>
    <button type='submit'>Go</button>

</form>

<hr>

<?php
if(get('msg')):

?>
    <h3 style="background: red"><?=$_GET['msg']?></h3>
    <?php endif;
    $i=0;
    foreach ($files as $file) ://ЗАГРУЗКА ФАЙЛОВ ИЗ ДИРЕКТОРИИ UPLOADS
        $i++;?>
        <div style="display: inline-block">
            <img src='uploads/<?=$file?>' width='100'>
            <p><?="Image $i"?></p>
            <a href="?action=delete&amp;file=<?=$file?>">		Delete
            </a>
        </div>

<?php  endforeach;?>


<hr>
</body>
</html>

