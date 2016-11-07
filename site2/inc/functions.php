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
    return post('username')!=''&&post('email')!=''&&post('message')!=''&&post('captcha')==$_SESSION['security_number'];
}
function loginFormIsValid(){
    return post('username')!=''&&post('password')!='';
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
        $comments[] = json_decode($comment, true);
    }

    return $comments;
}
function loadImages($file = COMMENTS_FILE)
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

function replase(&$item1, $key, array $badWords)
{
    foreach ($badWords as $k =>$w){
        if (mb_strlen($badWords[$k]) <= 2) {
            $item1['message'] = str_replace($badWords[$k], '**', $item1['message']);

        } elseif(mb_strlen($badWords[$k])==3) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1), '**', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==4) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,2), '**', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==5) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,3), '***', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==6) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,4), '****', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==7) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,5), '*****', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==8) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,6), '******', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==9) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,7), '*******', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==10) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,8), '********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==11) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,9), '*********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==12) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,10), '**********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==13) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,11), '***********', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==14) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,12), '************', $item1['message']);

        }
        elseif (mb_strlen($badWords[$k])==15) {
            $item1['message'] = str_replace(mb_substr($badWords[$k],1,13), '*************', $item1['message']);
            }
    }
}
function moderate(array &$comments){ //&$comments- изменит саму переменную
    //todo - использовать array_walk() вместо форич //done
    // Todo as - ** beach - b***h // done
   //$badWords=str_word_count(file_get_contents('badwords.txt'),1);

   $badWords = ['ass', 'bitch', 'smuck', 'fu'];
   //dd($badWords);
    array_walk($comments,'replase', $badWords);
//    foreach ($comments as &$com){
//       $com['message']=str_replace($badWords, '***', $com['message']);
//    }
}
//рейтинг
function updateRating($id, $num){
    $commentRaws = file(COMMENTS_FILE);
    file_put_contents(COMMENTS_FILE, "");
    foreach($commentRaws as $row){
        if(substr_count($row, $id)){
            $decoded_row = json_decode($row, true);
            $decoded_row['rating'] += $num;
            var_dump($decoded_row);
            $row = json_encode($decoded_row);
            file_put_contents(COMMENTS_FILE, $row.PHP_EOL, FILE_APPEND);
        }
        else{
            file_put_contents(COMMENTS_FILE, $row, FILE_APPEND);
        }
    }
}
//удаление комментов
function deleteComment($id){
    $commentRaws = file(COMMENTS_FILE);
    file_put_contents(COMMENTS_FILE, "");
    foreach($commentRaws as $row){
        if(substr_count($row, $id)){
            continue;
        }
        else{
            file_put_contents(COMMENTS_FILE, $row, FILE_APPEND);
        }
    }
}

function loadCSV($filename)//загружем все логины и пароли
{
    $file=file($filename);
//    foreach ($file as &$line){
//        $line=trim($line);
//    }

    $keys=explode(',', trim($file[0]));//ключи - логин и пароль
    array_shift($file);//убираем ключи
    foreach ($file as &$user){
        $user=explode(",", trim($user));
        $user=array_combine($keys,$user);
    }
    return $file;
}

function setFlash($message)
{
    $_SESSION['flash_message']=$message;
}

function getFlash()
{
    if(!isset($_SESSION['flash_message']))
    {
        return null;
    }
    $message=$_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
    return $message;
}

//функции для гаререи


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
    if (file_exists('data/image.txt')) {
        $data[] = loadImages('data/image.txt');

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
    if (file_exists('data/image.txt')) {
        $data[] = loadImages('data/image.txt');

        $imageName = [];

        foreach ($data as $image) {
            foreach ($image as $item){
                $imageName[] = $item;
            }
        }
        return $imageName;
    }
}
