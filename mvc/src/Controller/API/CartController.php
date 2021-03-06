<?php
namespace Controller\API;
use Library\Controller;
use Library\FormatterFactory;
use Library\Request;
use Library\Response;
use Model\Cart;

class CartController extends Controller
{
   public  function saveAction(Request $request){
       $format = $request->get('_format', 'json');
       $formatter = FormatterFactory::create($format);

       try{
           $cartService=$this->container->get('cart_service');
           $json=$request -> post('cart');
           $cartService->updateJson($json);
           $code=200;
           $message="Saved";

       } catch (\Exception $e){
           $message=$e->getMessage();
           $code=500;
       }

       $response = new Response($code, $message, $formatter);
       return $response;
   }
    public function addAction(Request $request)
    {
        // repo - check if exists & active
        $id = $request->get('id');
        $book = $this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
            ->find($id, $hydrateArray = true)
        ;
        $cart = new Cart();
        $cart->addProduct($id);

        $this->container->get('router')->redirect("/book-{$id}.html");


    }

    public function showListAction(Request $request)
    {
        $cart = new Cart();
        $repo = $this->container->get('repository_manager')->getRepository('Book');
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
         * 1. Order table in DB  (id, user-data(?), email, order_item_id, created, status)
         * 2. OrderItem table (id, product_id, price)
         * 3. Form, Model
         *
         *
         *
         **/
    }
}