<?php
namespace Model\Form;

use Library\Request;
class StyleForm
{
    public $id;
    public $name;

    /**
     * ContactForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->id = $request->get('id');
        $this->name = $request->get('name');
    }

    /**
     * @return bool
     */
    function isValid()
    {
        //TODO неправильно работает логика - форма не проверяется
        $res = $this->id !== '' && $this->name !== '';
        return $res;
    }
}