<?php
//$users=loadCSV('data/users.csv'); //загрузили юзеров
require 'models/user.php';
//getUser('a@a.a', '1234');
if (requestIsPost()){//если форма отправлена
//если запрос отправлен и заполнены поля
        if(loginFormIsValid()){
        //проверяем юзера
            $user['username'] = post('username'); // $_POST['username']
            $user['password'] = post('password');
            $user = findUser($user['username'], $user['password']);
            //dd($user); die;
            if ($user['email'] !== null&&$user['password']!==null) {
                $_SESSION['user'] = $user['email'];
                if (isset($_POST['remember'])) {
                    setcookie('username', post('username'), time() + 60*60*24*60);
                    setcookie('password', post('password'), time() + 60*60*24*60);
                }
                setFlash('Signed in');
                redirect('/index.php');

            }


            setFlash("User not found");
            redirect('/index.php?page=login');
    }
    setFlash('Fill the fields');
}
elseif(isset($_COOKIE['username'])&&isset($_COOKIE['password']))
{
    $user['username']=  $_COOKIE['username'];
    $user['password']= $_COOKIE['password'];
    $_SESSION['user']=$user_db['email'];
    setFlash('Signed in');
    //redirect
    redirect('/index.php');

}





?>

<h1>Sign in</h1>
<div class="container">

    <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input value="<?=post('username')?>" name="username" type="email" id="inputEmail" class="form-control" required placeholder="Email address"  autofocus="" >
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me" name="remember"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div>

<!--TODO:
 - remember me - записать куку на пару месяцев - done, при нажатии логаут - кука удаляется
 - применить к паролям md5
 - переделать trim - DONE
 - сделать обертку для проверки сессии
 - если не правильная капча - обновить - DONE
 - привязать галерею - DONE
 - удаление комментариев и рейтинг - done
-->
