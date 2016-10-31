<?php

function dd($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}
function post($key, $default=null)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
function get ($key, $default=null)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function noNotice($func_name, $key){
    return $func_name ($key);
}
function requestIsPost()
{
    return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
}

function formIsValid(){
    return post('username')!=''&&post('email')!=''&&post('message')!='';
}

function redirect($to){
    header("Location: ".$to);
    die;
}
function loadComments($file = COMMENTS_FILE)
{
    $commentsRaw = file($file);
    $comments = [];

    foreach ($commentsRaw as $comment) {
        $comments[] = unserialize($comment);
    }

    return $comments;
}

function ifPublish()
{
    return (int) (post('publish')!==null);
}
function ifDelete()
{
    return (int) (post('delPost')!==null);
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
$path_to_thumbs_directory = 'uploads';

function changeSize($file){ //изменение размера фото перед загрузкой на сервер
    //dd($file);
    global $path_to_thumbs_directory;
// Cоздаём исходное изображение на основе исходного файла
    if ($file['type'] == 'image/jpeg')
        $source = imagecreatefromjpeg($file['tmp_name']);
    elseif ($file['type'] == 'image/png')
        $source = imagecreatefrompng($file['tmp_name']);
    elseif ($file['type'] == 'image/gif')
        $source = imagecreatefromgif($file['tmp_name']);
    else
        return false;
// Определяем ширину и высоту изображения

    $w_src = imagesx($source);

    $h_src = imagesy($source);
    $w = 200;
// Если ширина больше заданной
    if ($w_src > $w)
    {
// Вычисление пропорций

        $ratio = $w_src/$w;

        $w_dest = round($w_src/$ratio);

        $h_dest = round($h_src/$ratio);

// Создаём пустую картинку
        $dest = imagecreatetruecolor($w_dest, $h_dest);
// Копируем старое изображение в новое с изменением параметров
        imagecopyresized($dest, $source, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
// Вывод картинки и очистка памяти
        if(!file_exists($path_to_thumbs_directory)) {
            if(!mkdir($path_to_thumbs_directory)) {
                die("Возникли проблемы! попробуйте снова!");
            }
        }


        imagejpeg($dest,  $path_to_thumbs_directory.'/'. $file['name']);
        imagedestroy($dest);
        imagedestroy($source);
        return $file['name'];
    }
    else
    {
// Вывод картинки и очистка памяти
        imagejpeg($source, $path_to_thumbs_directory.'/' . $file['name']);
        imagedestroy($source);
        return $file['name'];
    }
}

//загрузка альбома
function loadAlbum($name){
    $list=[];
    if(get('album')){
        $images=getImages();
        foreach ($images as $image){
            if ($image[0]==$name)
            {
                $list[]= $image[1];
            }
        }
        return $list;
    }
}
//получение списка альбомов
function getAlbum(){
    if (file_exists('image.txt')) {
        $data[] = loadComments('image.txt');

        $albumName = [];


        foreach ($data as $image) {
            foreach ($image as $item) {
                $albumName[] = $item[0];
            }
        }
        return $albumName = array_unique($albumName);
    }
}
//получение фото (имя и название альбома)
function getImages(){
    if (file_exists('image.txt')) {
        $data[] = loadComments('image.txt');

        $imageName = [];

        foreach ($data as $image) {
            foreach ($image as $item){
                $imageName[] = $item;
            }
        }
        return $imageName;
    }
}
