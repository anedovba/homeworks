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
        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $count = $repos->count();
        //$repos=new BookRepository();
//        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $books = $repos->findActiveByPage($page, self::BOOKS_PER_PAGE);
        //$books=$repos->findAll();
//        $books=$repos->findActive();
//        //достать инфо с базы
//        $books=['Book1', 'book2'];
//        $author='Mike';

        if (!$books && $count) {
            $this->container->get('router')->redirect('/books');
        }

        //TODO paginator

        $pagination = new Pagination(['itemsCount' => $count, 'itemsPerPage' => self::BOOKS_PER_PAGE, 'currentPage' => $page]);

//        $countOnPage=10;
//
//        $pageCount=$repos->pageCount($countOnPage);
//        $books=$repos->findOnePage(get('currentPage') ,$countOnPage);
        $args=['books'=>$books, 'pagination'=>$pagination /*, 'pageCount'=>$pageCount, 'countOnPage'=>$countOnPage, 'currentPage'=>get('currentPage')*/];

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