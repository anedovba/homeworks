<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 21.11.2016
 * Time: 21:52
 */
//Создать класс Fraction, который моделирует простую дробь с числителем и знаменателем. Определить методы конструктор, сокращения дроби и представления дроби в десятичном виде. Определить статические методы для арифметических операций с двумя дробями.
//В класс Fraction из предыдущих занятий (урок Статические Методы) добавить использование исключений при попытке деления на 0

class Fraction{
    public $a;
    public $b;

    private function getA(){
        return $this->a;
    }
    private function getB(){
        return $this->b;
    }
    private function checkZero($int){
       try{
           if (!($int)){
//            echo 'ошибка деления на 0';
//            die;
               throw new Exception('ошибка деления на 0');
           }
       }
       catch(Exception $e) {
            echo $e->getMessage();
           die;
       }
    //echo $int." проверка на 0 выполнена <br>";
    }
    public function  __construct($a, $b){
        $this->checkZero($b);
        $this->a=$a;
        $this->b=$b;

    }

    public function showFraction(){
        echo "$this->a/$this->b <br>";
    }

    public function reducingFraction(){
        for ( $i = $this->a; $i > 1; --$i ) {
            if ($this->a % $i == 0 && $this->b % $i == 0 ){
                $this->a /= $i;
                $this->b /= $i;
                break;
            }
        }
        return $this;
    }
    public function toDecimal(){
        return round($this->a/$this->b,2);
    }
    public static function sum(Fraction $f1, Fraction $f2){
       $f1=$f1->reducingFraction();
        $f2=$f2->reducingFraction();
        if($f1->getB()==$f2->getB()){
           $numerator=$f1->getA()+$f2->getA();
           $denominator= $f1->getB();
       }
       else {
           $numerator=$f1->getA()*$f2->getB()+$f2->getA()*$f1->getB();
           $denominator=$f1->getB()*$f2->getB();
       }
       $newF= new Fraction($numerator, $denominator);

       return $newF;
    }
    public static function dif(Fraction $f1, Fraction $f2){
        $f1=$f1->reducingFraction();
        $f2=$f2->reducingFraction();
        if($f1->getB()==$f2->getB()){
            $numerator=$f1->getA()-$f2->getA();
            $denominator= $f1->getB();
        }
        else {
            $numerator=$f1->getA()*$f2->getB()-$f2->getA()*$f1->getB();
            $denominator=$f1->getB()*$f2->getB();
        }
        $newF= new Fraction($numerator, $denominator);

        return $newF;
    }
    public static function cast(Fraction $f1, Fraction $f2){
        $numerator=$f1->getA()*$f2->getB();
        $denominator= $f1->getB()*$f2->getA();
        $newF= new Fraction($numerator, $denominator);
        $newF->reducingFraction();
        return $newF;
    }
    public static function mult(Fraction $f1, Fraction $f2){
        $numerator=$f1->getA()*$f2->getA();
        $denominator= $f1->getB()*$f2->getB();
        $newF= new Fraction($numerator, $denominator);
        $newF->reducingFraction();
        return $newF;
    }
}

$fraction = new Fraction(2,10);
echo '<pre>';
var_dump($fraction);
$fraction->showFraction();
$fraction->reducingFraction();
$fraction->showFraction();
echo $fraction->toDecimal().'<br>';

$fr2=new Fraction(3,5);

var_dump(Fraction::sum($fraction,$fr2));
var_dump(Fraction::dif($fr2,$fraction));
var_dump(Fraction::cast($fr2,$fraction));
var_dump(Fraction::mult($fr2,$fraction));

$fr3=new Fraction(3,0);
