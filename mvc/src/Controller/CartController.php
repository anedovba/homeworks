<?php
namespace Controller;
use Library\Controller;
use Library\Request;
use Model\Cart;
use Model\Repository\BookRepository;
class CartController extends Controller
{
    public function addAction(Request $request)
    {
        // TODO: repo - check if exists & active
        $id = $request->get('id');
        $cart = new Cart();
        $cart->addProduct($id);

        $this->container->get('router')->redirect("/book-{$id}.html");
    }

    /**
     * @param Request $request
     * @return string
     */
    public function showListAction(Request $request)
    {
        $cart = new Cart();//попытка достать из куков
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        //получаем книги из репозитория
        $books = $repo->findByIdArray($cart->getProducts());

        return $this->render('show.phtml', ['books' => $books]);
    }

    public function removeItemAction(Request $request)
    {

    }

    public function clearAction(Request $request)
    {

    }

    // maybe OrderController
    public function orderAction(Request $request)
    {
        /**
         * TODO: доработать базу сделать таблицы с заказами
         * 1. Order table in DB  (id, user-data(?), email, order_item_id, created, status)
         * 2. OrderItem table (id, product_id, price)
         * 3. Form, Model
         *
         *
         *
         **/
    }
}