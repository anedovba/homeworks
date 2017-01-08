<?php

namespace Controller;

use Library\Container;
use Library\Controller;
use Library\Password;
use Library\Request;
use Library\Router;
use Library\Session;
use Model\Form\LoginForm;


class SecurityController extends Controller
{
//TODO подтвердить регистрацию - добавляем таблицу с пользователем, колонка активный пользователь и не активный. как только он добавляется - неактивный. есть еще одна колонка - рандомный хеш мд5. Хеш вставляется в ссылку. как только ссылка передается - ссыдка на наш сайт (\activate?id=хеш мд5 и емаил) поиск в базе, в колонке активниый=1 и хеш вытирается. Письмо отправить через маил а лучше через свифтмейлер, send mail
//TODO  - изменить и пароль ввести текущий и два раза новый - сравнить все по мейлу который сейчас в сессиях и обновить в базе данных

    /**
     * @param Request $request
     */
    public function loginAction(Request $request)
    {
        $form= new LoginForm($request);//что б залогиниться надо юзер репозитори и модель юзера
        if($request->isPost()){
            if($form->isValid()){
                $password = new Password($form->password);
                $email = $form->email;

                $repos=$this->container->get('repository_manager')->getRepository('User');
                if($user=$repos->find($email,$password)){
                    //log
                    $this->container->get('logger')->addInfo('Successfull login',['user'=>$user->getEmail()]);

                    Session::set('user', $user->getEmail());
                    Session::setFlash('Success. You are in');
//                    Router::redirect('/');
                    $this->pageReload('/admin');
                }
                Session::setFlash('Fail. No user found');
//                Router::redirect('/index.php?route=security/login');
                // todo: make helpers like $this->redirect('/blah'), $this->pageReload() DONE
//                $this->container->get('router')->redirect('/login');
                $this->pageReload('/login');
            }
            Session::setFlash('Fill the fields');
        }
        return $this->render('login.phtml', ['form'=>$form]);
    }

    public function logoutAction(Request $request)
    {
        Session::remove('user');
//        Router::redirect('/');
        $this->pageReload('/');
    }

    public function registerAction(Request $request)
    {
        //TODO - подтвердить регистрацию
    }



}