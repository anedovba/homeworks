<?php
/**
 * Created by PhpStorm.
 * User: ANNA
 * Date: 22.11.2016
 * Time: 16:48
 */

//Создать интерфейс для класса User из предыдущих заданий

interface Iuser{
    public  function login();
    public function logout();
    public  function setLogin($login);
    public function setPassword($password);
    public function setEmail($email);
    public function setRating($rating);
}

class User implements Iuser {
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