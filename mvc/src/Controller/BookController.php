<?php
namespace Controller;
use Library\Controller;
use Library\Pagination\Pagination;
use Library\Request;
//use Model\Repository\BookRepository;

class BookController extends Controller 
{
    const BOOKS_PER_PAGE = 12;
    public function indexAction(Request $request)
    {
        $page=(int)$request->get('page',1);
        if ($page < 1)
        {
              $page=1;
        }
        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $count = $repos->count();
//        $books = $repos->findActiveByPage($page, self::BOOKS_PER_PAGE);
        $books = $repos->findActive();
        if (!$books && $count) {
            $this->container->get('router')->redirect('/books');
        }
        //TODO paginator - Done
        $pagination = new Pagination($count, self::BOOKS_PER_PAGE, $page);
        $args=['books'=>$books, 'pagination'=>$pagination];
        return $this->render('index.phtml', $args);
    }

    public function showAction(Request $request)
    {
        //TODO страничка с одной книгой DONE
        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $id = $request->get('id');
        $book = $repos->find($id);

        return $this->render('show.phtml', compact('book'));
    }

}