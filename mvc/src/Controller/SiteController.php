<?php
namespace Controller;

use Library\Controller;
//use Model\Repository\FeedbackRepository;
use Library\Request;
use Library\Router;
use Library\Session;
use Model\Form\ContactForm;
//use Library\DbConnection;
use Model\Feedback;


class SiteController extends Controller {

    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');

        //        $classname=str_replace(['Controller','\\'],'',__CLASS__);
//        ob_start();
//        require VIEW_DIR.$classname.DS.'index.phtml';
//        return ob_get_clean();
//        //return 'site/index';

    }
    public function contactAction(Request $request)
    {

        $form=new ContactForm($request);
//        $mapper=new FeedbackRepository();//надо убрать в контейнер
        $repos=$this->container->get('repository_manager')->getRepository('Feedback');

        if($request->isPost())
        {
            if($form->isValid())
            {
            //save to db
                $feedback=(new Feedback())
                    ->setName($form->username)
                    ->setEmail($form->email)
                    ->setMessage($form->message)
                    ->setIpAddress($request->getIpAddress())
                ;

                //$mapper->save($feedback);
                $repos->save($feedback);
                Session::setFlash('Feedback saved');
//                Router::redirect('/index.php?route=site/contact');
//                $this->container->get('router')->redirect('/contact-us');
                $this->pageReload('/contact-us');

            }
            Session::setFlash('Fill the fields');
        }
        $this->container->get('meta_helper')->addToTitle('Contact');
       return $this->render('contact.phtml', ['form'=>$form]);
    }
}