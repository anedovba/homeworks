<?php
//8. Изменить область видимости свойств класса User на protected. Унаследовать от класса User классы Manager, Admin. Создать объекты менеджера и админа, задать значения для свойств объектов.



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

}

class Manager extends User{

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
class Admin extends User{
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

$manager = new Manager();
$admin= new Admin();

$manager->setPassword('123');
$manager->setLogin('manager');
$manager->setEmail('a@a.a');
$manager->setRating(5);
$manager->login();

$admin->setPassword('456');
$admin->setLogin('admin');
$admin->setEmail('b@a.a');
$admin->setRating(4);
$admin->logout();

echo '<pre>';

var_dump($manager);
var_dump($admin);

