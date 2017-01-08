<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\Form\StyleForm;
use Library\Session;
use Model\Style;

class StyleController extends Controller
{
    public function indexAction(Request $request){
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
        $repos=$this->container->get('repository_manager')->getRepository('Style');
        $styles=$repos->findAll();
        $args=['styles'=>$styles];
        return $this->render('index.phtml', $args);
    }

    /**
     * @param Request $request
     */
    public function editAction(Request $request){
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
        $id=$request->get('id');

        $repo=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Style');
        $repo1=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Style')->find($id);


        $request->set('id',$repo1->getId());
        $request->set('name',$repo1->getName());
        $form=new StyleForm($request);

        if($request->isPost())
        {
            if($form->isValid())
            {

                //save to db
                $style=(new Style())
                    ->setId($request->post('id'))
                    ->setName($request->post('name'))
                ;

                //$mapper->save($feedback);
//                var_dump($repo); die;
                $repo->save($style);

                Session::setFlash('Style updated');
//                Router::redirect('/index.php?route=site/contact');
//                $this->container->get('router')->redirect('/contact-us');
                $this->pageReload('/admin/styles');

            }
            Session::setFlash('Fill the fields');
        }
        return $this->render('edit.phtml', ['form'=>$form]);

    }
}
