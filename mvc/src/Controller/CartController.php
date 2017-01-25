<?php
namespace Controller;
use Library\Controller;
use Library\Request;
use Model\Cart;
use Library\Session;
class CartController extends Controller
{
    public function addAction(Request $request)
    {
        // TODO: repo - check if exists & active
        $id = $request->get('id');
        $amount = $request->get('amount', 1);

//        $cart = new Cart();
//        $cart->addProduct($id);
//
//        $this->container->get('router')->redirect("/book-{$id}.html");

        try {
            $book = $this
                ->container
                ->get('repository_manager')
                ->getRepository('Book')
                ->find($id, $findOnlyActive = true)
            ;

        } catch (\Exception $e) {
            Session::setFlash('Book not found');
            $this->container->get('router')->redirect('/');
        }

        $this->container->get('cart_service')->addToCart($book, $amount);
        Session::setFlash('Book(s) added to cart');
        $this->container->get('router')->redirect("/book-{$id}.html");
    }

    /**
     * @param Request $request
     * @return string
     */
    public function showListAction(Request $request)
    {
//        $cart = new Cart();//попытка достать из куков
//        $repo = $this->container->get('repository_manager')->getRepository('Book');
//        //получаем книги из репозитория
//        $books = $repo->findByIdArray($cart->getProducts());
//
//        return $this->render('show.phtml', ['books' => $books]);

        $cartService = $this->container->get('cart_service');
        $cart = $cartService->getCart();

        $ids = [];

        foreach ($cart as $id => $amount) {
            $ids[] = $id;
        }

        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $books = $repo->findByIdArray($ids);

        return $this->render('show.phtml', ['books' => $books, 'cart' => $cart]);
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