<?php
// Создать контактную форму. Создать скрипт обработчик контактной формы. Создать класс ContactForm со свойствами, значения которых совпадают с названиями полей формы. Создать экземпляр класса ContactForm по массиву $_POST при отправке формы.

class ContactForm{
private $user;
private $pass;

    public function __construct($user, $pass )
    {
        $this->user=$user;
        $this->pass=$pass;
    }
}

if($_POST){
    $u=$_POST['user'];
    $p=$_POST['pass'];
    $newUser=new ContactForm($u,$p);
    echo '<pre>';
    var_dump($newUser);
}

?>

<form action="" method="post">
    User: <input type="text" name="user"> <br><br>
    Password: <input type="text" name="pass"> <br><br>
    <button>Go</button>
</form>
