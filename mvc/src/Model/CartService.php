<?php
namespace Model;
use Library\Cookie;
class CartService
{
//    private $cart;

    public function getCart()
    {
        $cart = Cookie::get('products');
//        return json_decode($cart);
        $cart = json_decode($cart);

        if (!$cart) {
            return new \stdClass();
        }
        return $cart;
    }

    // public function Cart()
    // {

    // }
    public function getCartJson()
    {
        return Cookie::get('products');
    }

    public function __construct()
    {
        $cart = Cookie::get('products');
        if (is_null($cart)) {
            $cart = json_encode([]);
            Cookie::set('products', $cart);
        }
    }

    public function addToCart(Book $book, $amount)
    {
        $cart = $this->getCart();
        $id = $book->getId();


        if (isset($cart->{$id})) {
            $cart->{$id} += $amount;
        } else {
            $cart->{"$id"} = $amount;
        }

        $cart = json_encode($cart);
        Cookie::set('products', $cart);
    }

    public function removeFromCart(Book $book)
    {
        $cart = $this->getCart();
        $id = $book->getId();

        if (isset($cart->$id)) {
            unset($cart->$id);
        }
    }

    public function count()
    {
        $cart = $this->getCart();
        return array_sum((array)$cart);
    }
}