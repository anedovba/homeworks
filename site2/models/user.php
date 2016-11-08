<?php
// достать юзера

/**
 * @param $email
 * @param $password
 * @return array|null
 */
function findUser($email, $password )
{
    //соединение с базой
    global $link;
    global $salt;
    $password=md5(md5($salt).$password);
    //prepare sql
    $sql="
    SELECT email, password FROM user 
    WHERE email=? 
    AND password=?
    ";
    $stmt = mysqli_stmt_init($link);
    //создаем подготавливаемый запрос
    if(mysqli_stmt_prepare($stmt, $sql)){
    //делаем связку параметров
    mysqli_stmt_bind_param($stmt, "ss", $email, $password );
    //выполняем запрос
    mysqli_stmt_execute($stmt);
    //определяем переменные для результата
    mysqli_stmt_bind_result($stmt, $email, $password);
    //выбираем значения
    mysqli_stmt_fetch($stmt);
   //mysqli_stmt_close($stmt);

    return compact('email', 'password');
    //завершаем запрос
}


    ////получаем результат,
    //$res=mysqli_query($link,$sql);
    ////вытягиваем строку
   // return mysqli_fetch_assoc($res);
   }