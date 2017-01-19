<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\Form\BookForm;
use Model\Style;
use Model\Book;
use Library\Session;
use Model\Author;
use Library\Pagination\Pagination;

class BookController extends Controller
{
const BOOKS_PER_PAGE = 20;
    public function indexAction(Request $request){
        //проверка что мы залогинены
        if(!Session::has('user')){
           $this->container->get('router')->redirect('/login');
        }
        $page=(int)$request->get('page',1);
        if ($page < 1)
        {
            $page=1;
        }
        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $count = $repos->countAll();
        $books = $repos->findAllByPage($page, self::BOOKS_PER_PAGE);

        if (!$books && $count) {
            $this->container->get('router')->redirect('/books');
        }
        //paginator
        $pagination = new Pagination($count, self::BOOKS_PER_PAGE, $page);
        $args=['books'=>$books, 'pagination'=>$pagination];
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

        //вытягиваем с базы все стили
        $styles=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Style')
            ->findAll();
        //сохраняем данные в get параметры

        $request->set('fTitle','Edit Book');
        $request->set('id',$book->getId());
        $request->set('title',$book->getTitle());
        $request->set('price',$book->getPrice());
        $request->set('description',$book->getDescription());
        $request->set('is_active',$book->getIsActive());
        $request->set('styles',$styles);
        $request->set('styleId',$book->getStyle()->getId());


        //передаем все в форму
        $form=new BookForm($request); // todo DONE
        //если форму отправили (подтвердили)
        if($request->isPost())
        {
            if($form->isValid()){
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
//
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

    public function addAction(Request $request)
    {
        // todo
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
        $repo=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
        ;
        //вытягиваем с базы все стили
        $styles=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Style')
            ->findAll();
//        dump($styles);
        //сохраняем данные в get параметры
        $request->set('fTitle','Add Book');
        $request->set('id','');
        $request->set('title','');
        $request->set('price','');
        $request->set('description','');
        $request->set('is_active','');
        $request->set('styles',$styles);
        $request->set('styleId','');

         //пустая форма и нет id

        $form=new BookForm($request);
        if($request->isPost())
        {
//            if($form->isValid()){
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
//
                //сохраняем в базу изменения - через метод в BookRepository
                $repo->save($book);
                Session::setFlash("Book \"{$book->getTitle()}\" added success");
                $this->pageReload('/admin/books');
//            }
//            Session::setFlash('Fill the fields');
        }
        return $this->render('edit.phtml', ['form'=>$form]);
    }

    public function deleteAction(Request $request)
    {
        //проверка что мы залогинены
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }
        $id=$request->get('id');

        $book=$this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
            ->find($id);
        $this
        ->container
        ->get('repository_manager')
        ->getRepository('Book')
        ->removeById($id);

        Session::setFlash("Book \"{$book->getTitle()}\" deleted");

        $this->pageReload('/admin/books');

    }
}