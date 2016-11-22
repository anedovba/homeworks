<?php
//9. Создать экземпляр класса User с конкретными значениями свойств и клонировать его в новую переменную. Свойствам нового экземпляра присвоить новые значения. Сравнить полученные экземпляры класса.

class User{
    protected $login;
    protected $password;
    protected $email;
    protected $rating=0;
    protected $isLogged;

    public  function login(){
        $this->isLogged=true;
        echo 'login <br>';
    }
    public function logout(){
        $this->isLogged=false;
        echo 'logout <br>';
    }
    public  function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}



$user = new User();
$user->setLogin('anna');
$user->setPassword('123');
$user->setEmail('a@a.a');
$user->setRating(5);
$user->login();

$newUser= clone $user;
$newUser->setLogin('Alex');
$newUser->setPassword('321');
$newUser->setEmail('alex@a.a');
$newUser->setRating(12);
$newUser->logout();
echo '<pre>';
var_dump($user);
var_dump($newUser);
