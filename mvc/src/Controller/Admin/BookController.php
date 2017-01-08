<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\Form\BookForm;
use Model\Style;
use Model\Book;
use Library\Session;

class BookController extends Controller
{
    public function indexAction(Request $request){
        //проверка что мы залогинены
        if(!Session::has('user')){
           $this->container->get('router')->redirect('/login');
        }
        $repos=$this->container->get('repository_manager')->getRepository('Book');

        $books=$repos->findAll();

        $args=['books'=>$books];

        return $this->render('index.phtml', $args);
    }


    public function editAction(Request $request)
    {
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
        //todo edit book добавить форму для редактирования в репозитори DONE
        $id=$request->get('id');
        //обращение к BookRepository
        $repo=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
            ;
        //обращение к BookRepository методу find($id) - вытягиваем из базы книгу по id
        $book=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
            ->find($id);
//        echo "<div style='margin-left: 300px'>";
//        var_dump($book);
//        echo "</div>";
        //вытягиваем с базы все стили
        $styles=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Style')
            ->findAll();
        //сохраняем данные в get параметры
        $request->set('id',$book->getId());
        $request->set('title',$book->getTitle());
        $request->set('price',$book->getPrice());
        $request->set('description',$book->getDescription());
        $request->set('is_active',$book->getIsActive());
        $request->set('styles',$styles);
        //передаем все в форму
        $form=new BookForm($request); // todo DONE

        //если форму отправили (подтвердили)
        if($request->isPost())
        {
            if($form->isValid()){
//                echo "<pre>";
//                var_dump($styles); die;
                $key=null;
                foreach ($styles as $stile){
                    if ($stile->getName()===$request->post('styles')){
                        $key=$stile->getId();
                    }
                }

                $style=(new Style())
                    ->setId($key)
                    ->setName($request->post('styles'))
                ;
                $flag=0;
                if($request->post('is_active')==='on'){
                    $flag=1;
                }
                $book=(new Book())
                    ->setId($request->post('id'))
                    ->setTitle($request->post('title'))
                    ->setDescription($request->post('description'))
                    ->setPrice($request->post('price'))
                    ->setIsActive($flag)
                    ->setStyle($style)
                ;
//                echo "<pre>";
//                var_dump($book);
                //сохраняем в базу изменения - через метод в BookRepository
             $repo->save($book);
                Session::setFlash("Book \"{$book->getTitle()}\" updated");
                $this->pageReload('/admin/books');
            }
            Session::setFlash('Fill the fields');
        }
        //открываем форму
        return $this->render('edit.phtml', ['form'=>$form]);
    }

    public function newAction(Request $request)
    {
        // todo
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
         //пустая форма и нет id

//        $form=new BookForm();
//        if($request->isPost())
//        {
//            if($form->isValid()){
//
//
//
//
//            }
//        }
    }

    public function deleteAction(Request $request)
    {
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
//        $id=$request->get('id');
//        $this
//            ->container
//            ->get('repository_manager')
//            ->getRepository('Book')
//            ->removeById($id);
    }
}