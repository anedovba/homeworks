<?php
namespace Model;

class Style
{
    private $id;
    private $name;
//    private $books;
//
//    /**
//     * @return mixed
//     */
//    public function getBooks()
//    {
//        return $this->books;
//    }
//
//    /**
//     * @param mixed $books
//     */
//    public function setBooks($books)
//    {
//        $this->books = $books;
//        return $this;
//    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



}