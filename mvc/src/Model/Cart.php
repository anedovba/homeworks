<?php

namespace Model;

use Library\Cookie;

/**
 * Class Cart
 */
//TODO: написать карт сервис
class Cart
{
    /**
     * Products array
     *
     * @var array|mixed
     */
    private $products; // тут массив айдишников


    /**
     *  Constructor
     */
    function __construct()
    {
        //получаем массив продуктов
        $this->products = Cookie::get('books') == null ?
            array()
            :
            unserialize(Cookie::get('books'));
    }


    /**
     * products getter
     *
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

//    public function getImplodedProducts()
//    {
//        //для возврата списка покупок
//        return implode(',', $this->products);
//    }
    /**
     * adding product
     *
     * @param $id
     */
    public function addProduct($id)
    {
        $id = (int)$id;

        if (!in_array($id, $this->products)) {
            array_push($this->products, $id);
        }

        Cookie::set('books', serialize($this->products));
    }


    /**
     * deleting product
     *
     * @param $id
     */
    public function deleteProduct($id)
    {
        $id = (int)$id;

        $key = array_search($id, $this->products);
        if ($key !== false){
            unset($this->products[$key]);
        }

        Cookie::set('books', serialize($this->products));
    }


    /**
     *  clear cart
     */
    public function clear()
    {
        Cookie::delete('books');
    }



    /**
     * check if empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->products;
    }

    public function count(){
        if($this->isEmpty()){
            return 0;
        }

        return count($this->products);
    }

}