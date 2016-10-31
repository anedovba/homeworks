<?php

//Создать подключение PDO для базы данных из практических заданий practice_db
//Получить выборку по всей таблице со странами country. Вывести соответствующий массив на экран
$dsn = 'mysql:host=localhost; dbname=practice_db';
$user = 'root';
$password = '';
try {

    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    var_dump($dbh); // object(PDO)#1 (0) { }
} catch (PDOException $e) {
    echo $e->getMessage();
}
$sth = $dbh->query('SELECT * FROM country');
$countries = $sth->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($countries);
echo '</pre>';

//Получить вывести из скрипта на экран выборки из предыдущих заданий
$dsn = 'mysql:host=localhost; dbname=practice_db';
$user = 'root';
$password = '';
try {

    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('SELECT * FROM country');
    $params = array();
    $sth->execute($params);
    $countries = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($countries);
    echo '</pre>';

} catch (PDOException $e) {
    echo $e->getMessage();
}
