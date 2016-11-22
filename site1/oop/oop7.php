<?php
// Создать класс со статическим свойством, которое будет содержать значение количества созданных экземпляров.

class A{
    public static $count=0;

    public function __construct()
    {
        self::$count+=1;
    }
}

$obj1=new A();
$obj2=new A();
$obj3=new A();
$obj4=new A();
echo '<pre>';
var_dump(A::$count);