<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Library\Session;

class MenuController extends Controller
{
    public function indexAction(Request $request)
    {
        //проверка что мы залогинены
        if(!Session::has('admin')){
            $this->container->get('router')->redirect('/login');
        }

        return $this->render('index.phtml');
    }



}