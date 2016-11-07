<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 11.10.2016
 * Time: 19:09
 */

//todo:
// 1 ограничение на размер проверка типов фото - готово
//2 динамически изменить размер файла - готово
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

//require 'inc/functions.php';
if (!file_exists('uploads')) {
    mkdir('uploads');
}

if (requestIsPost()) {
    if (isset($_FILES['attachment'])) {
        $files = $_FILES['attachment'];
        $files = reArrayFiles($files);

        foreach ($files as &$file) {

            if (!fileHasNoError($file)) {
                $er=$file['error'];
                setFlash("error type $er");
                redirect('/index.php?page=gallery');
                continue;
            }
               $types=['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/svg+xml', 'image/tiff', 'image/vnd.microsoft.icon', 'image/vnd.wap.wbmp', 'image/webp'];
            if (!fileIsOfTypes($file,$types)) {
                setFlash("error wrong type");
                redirect('/index.php?page=gallery');
                continue;
            }

            if(!fileIsLessThan($file,30000000000)){
                setFlash("error size is too big");
                redirect('/index.php?page=gallery');
                continue;
            }


            $filename = uniqid();
            $extension = explode('.', $file['name']);
            $extension = end($extension);
            // new full filename
            $filename .= ".$extension";
            $file['tmp_name']=changeSize($file);
//            $move_result = move_uploaded_file(
//                $file['tmp_name'],
//                'uploads/' . $filename
//            );
//             if (!$move_result) {
//                header('HTTP/1.1 500 Internal Server Error');
//                continue;
//            }


            $filename=changeSize($file);


            if(post('album')) {
                $album = $_POST['album'];
                echo $album;
            }
            else
                $album="none";
            echo $album;
            //
            if (!file_exists('data/image.txt')){
                $file=fopen('data/image.txt',"a");
                fclose($file);
            }

            file_put_contents('data/image.txt',serialize([$album, $filename]).PHP_EOL,FILE_APPEND);
        }
        setFlash('files were uploaded');
        redirect('/index.php?page=gallery');
    }
}

if (get('action') == 'delete') {
    if (!file_exists(get('file'))) {
        unlink('uploads/' . get('file'));
        $images=loadImages('data/image.txt');
        $file=fopen('data/image.txt','w');
        fclose($file);
        foreach ($images as &$image){

            if ($image[1]==get('file')){
                unset($image);
            }
            else
            {
                file_put_contents('data/image.txt',serialize($image).PHP_EOL,FILE_APPEND);
            }
        }

    }
    setFlash('files were deleted');
    redirect('/index.php?page=gallery');
}

$files = scandir('uploads');
//dd($files);
array_shift($files);//УДАЛЯЕМ '.' И '..' В МАССИВЕ ДИРЕКТОРИЙ
array_shift($files);
?>
<?php //if(get('msg')):?>
<!--    <h3 style="background: red">--><?//=$_GET['msg']?><!--</h3>-->
<?php //endif;?>

<h2>Gallery</h2>
<hr>
<form 	action="" method='post' enctype="multipart/form-data" class="form-group">
    <input type="file" name="attachment[]" multiple class="" > <br>
    <br>
    <input type="text" name="album" class="form-control-text"> Укажите название альбома <br>
    <br>
    <button type='submit' class="btn btn-primary">Go</button>

</form>

<hr>



<h3>Альбомы</h3>
<hr>
<?php
    $a=getAlbum();
    if (isset($a)){
        foreach ($a as $item){

            echo "<div style='display: inline-block'>
                    <ul>
                    <li>
                    <a href='?page=gallery&album=$item'>$item</a>
                    </li>
                    </ul>
                    </div>";
        }
    }
$imgList=loadAlbum(get('album'));
$i=0;
    echo '<div>';
    foreach ($files as $file) ://ЗАГРУЗКА ФАЙЛОВ ИЗ ДИРЕКТОРИИ UPLOADS
        if(isset($imgList)&&in_array($file,$imgList)):?>
                <div style="display: inline-block">
                <img src='uploads/<?=$file?>' >
                <p><?="$file"?></p>
                <a href="?page=gallery&action=delete&amp;file=<?=$file?>">		Delete
                </a>
                </div>
<?php
endif;
endforeach;?>
    </div>


