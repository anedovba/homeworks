<?php
namespace Model\Repository;

//use Library\DbConnection;
use Library\EntityRepository;
use Library\Session;
use Model\Book;
use Model\Style;


class BookRepository extends EntityRepository
{
    //массив книжек для корзины
    public function findByIdArray(array $ids)
    {
        // $ids=implode(',', $ids);
        //считаем сколько ID в массиве
//        $ids=array(1,5,6,8,9,10);
        if (!$ids) {
return [];
        }
        $params=[];
        foreach ($ids as $id) {
            $params[]='?';
        }
        $params=implode(',', $params);
//        $sth=$this->pdo->query("select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id where id in ($ids) and is_active=1 ORDER BY book.id"); // in (3,5,7,4)
        $sth=$this->pdo->prepare("select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id where is_active=1 AND book.id in ({$params})"); // in (?,?,?)
        $sth->execute($ids);

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){

            $style=(new Style())
                ->setId($row['style_id'])
                ->setName($row['name'])
            ;
            $book=(new Book())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description'])
                ->setPrice($row['price'])
                ->setIsActive($row['is_active'])
                ->setStyle($style)
            ;
            $books[]=$book;
        }
        return $books;
    }
    //количество книг на странице храним в котнроллере
    public function findActiveByPage($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id where is_active=1 ORDER BY book.id LIMIT {$offset}, {$perPage}";

        $sth = $this->pdo->query($sql);

        $books = [];

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $style=(new Style())
                ->setId($row['style_id'])
                ->setName($row['name'])
            ;
            $book=(new Book())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description'])
                ->setPrice($row['price'])
                ->setIsActive($row['is_active'])
                ->setStyle($style)
            ;
            $books[]=$book;

        }
        return $books;
    }

    /**
     * @param bool $active
     * @return mixed
     * количество записей в бд
     */
    public function count($active=true){
        $sql = 'select count(*) from book';
        if($active)
        {
            $sql.=' where is_active=1';
        }
        $sth=$this->pdo->query($sql);
        //возвращает значение
        return $sth->fetchColumn();
       // $res=$re
    }

    public function findAll($hydrateArray=false)//$hydrateArray - для API что б в итоге получить ассоциативный массив
    {
        //TODO: join, DONE
        $sth=$this->pdo->query('select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id ORDER BY book.id');

        //info to API
        if($hydrateArray)
        {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }

        $books=[];
        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            //TODO: Style DONE
            $style=(new Style())
                ->setId($row['style_id'])
                ->setName($row['name'])
            ;
            $book=(new Book())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description'])
                ->setPrice($row['price'])
                ->setIsActive($row['is_active'])
                ->setStyle($style)
                ;
            $books[]=$book;
        }
        return $books;
    }

    public function findActive(){
        //$pdo=DbConnection::getInstance()->getPdo();
        $sth=$this->pdo->query('select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id where is_active=1 ORDER BY book.id');

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $style=(new Style())
                ->setId($row['style_id'])
                ->setName($row['name'])
            ;
            $book=(new Book())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description'])
                ->setPrice($row['price'])
                ->setIsActive($row['is_active'])
                ->setStyle($style)
            ;
            $books[]=$book;
        }
        return $books;
    }

    public function pageCount($countOnPage)
    {
        $sth = $this->pdo->query("SELECT COUNT(*) as c FROM book");
        //Запрашиваем число записей
        $res=$sth->fetch(\PDO::FETCH_ASSOC);

      $PagesCount=intval(($res['c'] - 1) / $countOnPage) + 1; //Узнаем число страниц
        return  $PagesCount;
    }

    public function findOnePage($currentPage, $countOnPage)
    {
        $currentPage-=1;
        $sth = $this->pdo->query("SELECT * FROM book LIMIT {$currentPage} {$countOnPage}");
        //Запрашиваем число записей
        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $style=(new Style())
                ->setId($row['style_id'])
                ->getName($row['name'])
            ;
            $book=(new Book())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description'])
                ->setPrice($row['price'])
                ->setIsActive($row['is_active'])
                ->setStyle($style)
            ;
            $books[]=$book;
        }
        return $books;
    }

    public function find($id)
    {
        $query="select book.id as id, title, description, price, is_active, style_id, name from book JOIN style ON style_id=style.id where book.id=$id ORDER BY book.id";
        $sth=$this->pdo->query($query);

//        $sth->execute(compact($id));

        $data=$sth->fetch(\PDO::FETCH_ASSOC);

        if(!$data)
        {
           throw new \Exception('not found');
        }

        if ($data){
            $style=(new Style())
                ->setId($data['style_id'])
                ->setName($data['name'])
            ;

            $book=(new Book())
                ->setId($data['id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setPrice($data['price'])
                ->setIsActive($data['is_active'])
                ->setStyle($style)
            ;

        }
        return $book;
    }

    public function save(Book $book, $table=null)
    {
        //if id===null - insert else update where id=123
        $class=explode('\\',get_class($book));

        $class=end($class);
        if($table==null){
            $table=strtolower($class);
        }

        $query="update {$table} set title=:title, description=:description, price=:price, is_active=:is_active, style_id=:style_id where id=:id";
        $sth=$this->pdo->prepare($query);


        $sth->execute(array(
            'title'=>$book->getTitle(),
            'description'=>$book->getDescription(),
            'price'=>$book->getPrice(),
            'is_active'=>$book->getIsActive(),
            'style_id'=>$book->getStyle()->getId(),
            'id'=>$book->getId())
        );

    }


}