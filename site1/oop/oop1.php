<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 20.11.2016
 * Time: 22:26
 */

//1. Создать класс User со свойствами login, password, email, rating. По умолчанию значение рейтинга задать нулевым.
////2. Создать класс Car. Записать в этот класс свойства brand, model, year, driver. Создать экземпляры машин Toyota Corolla (2000), Mazda 6 (2015), Ford Taurus (1995) . В рамках предыдущего задания создать экземпляры класса User для нескольких пользователей системы. В свойство driver объектов класса Car записать объекты класса User. Вывести объекты класса Car на экран при помощи var_dump(), print_r()
//3. Для класса User из предыдущего занятия создать методы login(), logout(), которые просто выводят на экран соответствующее сообщение. Создать экземпляр класса, вызвать созданные методы.
//4. Создать массив, который описывает сообщение ключами name, email, message с соответствующими значениями. Привести массив к объекту. Проанализировать результат при помощи var_dump.
//5. В класс Car из предыдущих заданий добавить методы showBrand(), showModel() которые выводят на экран значения свойств brand, model соответственно. В класс User из предыдущих заданий добавить свойство isLogged, которое принимает true, если пользователь успешно авторизировался, и false при выходе из системы. Задать значения для этого свойства в методах login(), logout().
//6. В класс Car из предыдущих заданий добавить private свойство price, а также публичные геттер и сеттер для него. Геттер должен зависеть от одного параметра. В зависимости от того, было ли в функцию геттера передано true, выводить отформатированную цену, либо же в обычном виде (использовать функцию number_format). Сеттер должен приводить входящий параметр к числу, у которого не более 2 знаков после запятой (использовать round).
//7. Унаследовать от класса Car из предыдущих занятий класс WaterCar со свойством waterSpeed.
// В класс User из предыдущих заданий добавить магические методы __get, __set для закрытых свойств, которые будут возвращать / присваивать соответствующие значения.

class User{
    public $login;
    public $password;
    public $email;
    public $rating=0;
    public $isLogged;

    public  function login(){
        $this->isLogged=true;
        echo 'login <br>';
    }
    public function logout(){
        $this->isLogged=false;
        echo 'logout <br>';
    }
    public function __get($name)
    {
        if (isset( $this->name)){
            return $this->name;
        }
    }
    public function __set($name, $value)
    {
        $this->name=$value;
    }
}

class Car{
    public $brand;
    public $model;
    public $year;
    public $driver;
    private $price=0;

    public function getPrice($i=true){
    if($i){
        return number_format(($this->price),2,'.',' ');
    }
        else
        {
            return $this->price;
        }
    }

    public function setPrice($val){

        return $this->price=round(($this->price=$val), 2);
    }

    public function showBrand(){
        echo $this->brand;
    }
    public function showModel(){
        echo $this->model;
    }
}

class WaterCar extends Car{
    public $waterSpeed;
}


$car1=new Car();
$car1->brand='Toyota';
$car1->model='Corolla';
$car1->year=2000;

$car2=new Car();
$car2->brand='Mazda';
$car2->model='6';
$car2->year=2015;

$car3=new Car();
$car3->brand='Ford';
$car3->model='Taurus';
$car3->year=1995;

$user1= new User();
$user1->login='anna';
$user1->password='123';
$user1->email='a@a.a';
$user1->rating=5;
$user1->login();
$user1->logout();
// __set, __get
$user1->age=25;
echo $user1->age.'<br>';
echo $user1->password.'<br>';


$user2= new User();
$user2->login='alex';
$user2->password='456';
$user2->email='b@a.a';
$user2->rating=0;

$user3= new User();
$user3->login='pit';
$user3->password='789';
$user3->email='c@a.a';
$user3->rating=4;

$car1->driver=$user1;
$car2->driver=$user2;
$car3->driver=$user3;

echo '<pre>';
var_dump($car1);
var_dump($car2);
var_dump($car3);

print_r($car1);
print_r($car2);
print_r($car3);

//4.

$arr=array('name'=>'anna', 'email'=>'a@a.a', 'message'=>'Hello');
$obj=(object)$arr;
var_dump($obj);
