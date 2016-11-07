<?php
setFlash('Signed out');
unset($_SESSION['user']);
setcookie("username","");
setcookie("password",'');
redirect('/');