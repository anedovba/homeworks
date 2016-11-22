<?php

// В класс Car из предыдущих заданий добавить конструктор, который выводит сообщение Car created при создании нового экземпляра класса.
// Создать контактную форму. Создать скрипт обработчик контактной формы. Создать класс ContactForm со свойствами, значения которых совпадают с названиями полей формы. Создать экземпляр класса ContactForm по массиву $_POST при отправке формы.

class Car{
    public $brand;
    public $model;
    public $year;
    public $driver;
    private $price=0;

    public function __construct()
    {
        echo "Car created";
    }

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

$car=new Car();