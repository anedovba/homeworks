<?php

namespace Model\Form;

use Library\Request;
class BookForm
{
    public $fTitle;
    public $id;
    public $title;
    public $description;
    public $price;
    public $styles;
    public $is_active;
    public $styleId;
    public $authors;



    /**
     * ContactForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->fTitle=$request->get('fTitle');
        $this->id = $request->get('id');
        $this->title = $request->get('title');
        $this->description = $request->get('description');
        $this->price = $request->get('price');
        $this->styles = $request->get('styles');
        $this->is_active = $request->get('is_active');
        $this->styleId = $request->get('styleId');

    }

    /**
     * @return bool
     */

    function isValid()
    {
        //TODO неправильно работает логика - форма не проверяется
        $res = $this->id !== '';
        return $res;
    }
}