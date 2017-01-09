<?php
namespace Model\Repository;

//use Library\DbConnection;
use Library\EntityRepository;
use Library\Session;
use Model\Book;
use Model\Style;
use Model\Author;

class BookRepository extends EntityRepository
{
    const SQLDATA='book.id as id, title, description, price, is_active, style_id, name, GROUP_CONCAT(author_id) as author_id';
    private function findAuthor($id){

        $sth=$this->pdo->query("select * from author where id={$id} ");
        $data=$sth->fetch(\PDO::FETCH_ASSOC);

        if(!$data)
        {
            throw new \Exception('not found');
        }

        if ($data){
            $author=(new Author())
                ->setId($data['id'])
                ->setFirstName($data['first_name'])
                ->setLastName($data['last_name'])
                ->setDateBirth($data['date_birth'])
                ->setDateDeath($data['date_death']);
        }
        return $author;
    }
    //массив книжек для корзины
    public function findByIdArray(array $ids)
    {

        if (!$ids) {
            return [];
        }
        $params=[];
        foreach ($ids as $id) {
            $params[]='?';

        }
        $params=implode(',', $params);

        $sth=$this->pdo->prepare("select ".self::SQLDATA." from book JOIN style ON style_id=style.id AND book.id in ({$params}) and is_active=1 LEFT JOIN book_author ON book.id=book_id  GROUP BY book.id ORDER BY book.id"); // in (?,?,?)
        $sth->execute($ids);

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){

            $books[]=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
        }
        return $books;
    }

    /**
     * количество книг на странице храним в котнроллере
     * @param $page
     * @param $perPage
     * @return array
     */
    public function findActiveByPage($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "select ".self::SQLDATA." from book JOIN style ON style_id=style.id and is_active=1 LEFT JOIN book_author ON book.id=book_id GROUP BY book.id ORDER BY book.id LIMIT {$offset}, {$perPage}";

        $sth = $this->pdo->query($sql);

        $books = [];

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $books[]=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
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

    /**
     * @param bool $hydrateArray
     * @return array
     */
    public function findAll($hydrateArray=false)//$hydrateArray - для API что б в итоге получить ассоциативный массив
    {
        //TODO: join, DONE
        $sth=$this->pdo->query('select '.self::SQLDATA.' from book JOIN style ON style_id=style.id LEFT JOIN book_author ON book.id=book_id GROUP BY book.id ORDER BY book.id');

        //info to API
        if($hydrateArray)
        {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }

        $books=[];

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            //TODO : author
            //TODO: Style DONE
            $books[]=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
        }

        return $books;
    }

    public function findActive(){

        $sth=$this->pdo->query('select '.self::SQLDATA.' from book JOIN style ON style_id=style.id and is_active=1 LEFT JOIN book_author ON book.id=book_id GROUP BY book.id ORDER BY book.id');

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $books[]=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
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

    public function find($id)
    {
        $query="select ".self::SQLDATA." from book JOIN style ON style_id=style.id and book.id=$id LEFT JOIN book_author ON book.id=book_id ORDER BY book.id";
        $sth=$this->pdo->query($query);

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

    private function createBook($autor_id, $style_id, $name, $id, $title, $description, $price, $is_active)
    {
        $author_id=explode(',', $autor_id);
        $authors=[];

        foreach ($author_id as $idA){
            if($idA===''){
                $authors[]=(new Author())
                    ->setId('')
                    ->setFirstName('')
                    ->setLastName('')
                    ->setDateBirth('')
                    ->setDateDeath('');
                continue;

            }
            $authors[]=$this->findAuthor($idA);

        }

        $style=(new Style())
            ->setId($style_id)
            ->setName($name)
        ;
        $book=(new Book())
            ->setId($id)
            ->setTitle($title)
            ->setDescription($description)
            ->setPrice($price)
            ->setIsActive($is_active)
            ->setStyle($style)
            ->setAuthors($authors)
        ;
        $books[]=$book;
        return $book;
    }


}