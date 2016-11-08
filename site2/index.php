<?php

//$plain_password='1234';
//$salt='This is some string';
//
//echo $pass=md5(md5($salt).$plain_password);


$salt='This is some string';
$link=mysqli_connect(
    "127.0.0.1",
    "root",
    "",
    "mvc_group_609"
);
session_start();
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 24.10.2016
 * Time: 23:24
 */
//ссылки со всех страниц ведут на индекс а потом в зависимости от того что передается - загружается нужная страница
//индекс - единая точка входа

//вставляем дефолтній скрипт

require 'inc/functions.php';
//$_GET['page'] if not set then = 'home'
$page=get('page','home');

//в папке pages coхраняются файлы которые мы будем сохранять через гет
//инклудим
$page.='.php';
//устранение проблеммы когда в адресной строке ввели несуществующую страницу

$pages_avaliable=scandir('pages');
array_shift($pages_avaliable);
array_shift($pages_avaliable);

if(!in_array($page,$pages_avaliable)){
//header('HTTP/1.0 404 Not Found');
    $page='404.php';
   // die;
}

//что б эта инфа не выводилась раньше layout - надо ее придержать
ob_start();
require 'pages/'.$page;
$content=ob_get_clean();



require 'layout.php';
