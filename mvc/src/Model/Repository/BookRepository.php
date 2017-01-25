<?php
namespace Model\Repository;

//use Library\DbConnection;
use Library\EntityRepository;
use Library\Session;
use Model\Book;
use Model\Style;
use Model\Author;

/**
 * Class BookRepository
 * @package Model\Repository
 */
class BookRepository extends EntityRepository
{
    /**
     *
     */
    const SQLDATA='book.id as id, title, description, price, is_active, style_id, name, GROUP_CONCAT(author_id) as author_id';

    /**
     * @param $id
     * @return $this
     * @throws \Exception
     */
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

    /**
     * массив книжек для корзины
     * @param array $ids
     * @return array
     */
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
     * @param $page
     * @param $perPage
     * @return array
     */
    public function findAllByPage($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "select ".self::SQLDATA." from book JOIN style ON style_id=style.id LEFT JOIN book_author ON book.id=book_id GROUP BY book.id ORDER BY book.id LIMIT {$offset}, {$perPage}";

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
     * @return mixed
     */
    public function countAll(){
        $sql = 'select count(*) from book';
        $sth=$this->pdo->query($sql);
        //возвращает значение
        return $sth->fetchColumn();
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

    /**
     * @return array
     */
    public function findActive(){

        $sth=$this->pdo->query('select '.self::SQLDATA.' from book JOIN style ON style_id=style.id and is_active=1 LEFT JOIN book_author ON book.id=book_id GROUP BY book.id ORDER BY book.id');

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $books[]=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
        }
        return $books;
    }

    /**
     * @param $countOnPage
     * @return int
     */
    public function pageCount($countOnPage)
    {
        $sth = $this->pdo->query("SELECT COUNT(*) as c FROM book");
        //Запрашиваем число записей
        $res=$sth->fetch(\PDO::FETCH_ASSOC);

      $PagesCount=intval(($res['c'] - 1) / $countOnPage) + 1; //Узнаем число страниц
        return  $PagesCount;
    }

    /**
     * @param $id
     * @return $this
     * @throws \Exception
     */
    public function find($id, $findOnlyActive = false, $hydrateArray = false)
    {
        $query="select ".self::SQLDATA." from book JOIN style ON style_id=style.id and book.id=$id LEFT JOIN book_author ON book.id=book_id ORDER BY book.id";
        if ($findOnlyActive) {
            $query = "select ".self::SQLDATA." from book JOIN style ON style_id=style.id and book.id=$id and is_active = 1 LEFT JOIN book_author ON book.id=book_id ORDER BY book.id";
        }
        $sth=$this->pdo->query($query);

        $row=$sth->fetch(\PDO::FETCH_ASSOC);

        if(!$row)
        {
           throw new \Exception('not found');
        }
        if ($hydrateArray) {
            return $row;
        }

        if ($row){
            $book=$this->createBook($row['author_id'], $row['style_id'], $row['name'], $row['id'], $row['title'], $row['description'], $row['price'], $row['is_active']);
        }
        return $book;
    }

    /**
     * @param Book $book
     * @param null $table
     */
    public function save(Book $book, $table=null)
    {
        if ($book->getId()== ''){
            $class=explode('\\',get_class($book));

            $class=end($class);
            if($table==null){
                $table=strtolower($class);
            }
            $title=$book->getTitle();
            $description=$book->getDescription();
            $price=$book->getPrice();
            $is_active=$book->getIsActive();
            $style_id=$book->getStyle()->getId();

            $query="insert INTO {$table} (title, description,  price, is_active, style_id) VALUES ('$title', '$description', $price, $is_active, $style_id)";
            $sth=$this->pdo->query($query);


//            $sth->execute(array(
//                    'title'=>$book->getTitle(),
//                    'description'=>$book->getDescription(),
//                    'price'=>$book->getPrice(),
//                    'is_active'=>$book->getIsActive(),
//                    'style_id'=>$book->getStyle()->getId())
//            );
//
        }
        else {
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

    /**
     * @param $autor_id
     * @param $style_id
     * @param $name
     * @param $id
     * @param $title
     * @param $description
     * @param $price
     * @param $is_active
     * @return $this
     */
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
//            dump($idA);
//            $authors[]=$this->container->get('repository_manager')->getRepository('Author')->findAuthors($idA);
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
        return $book;
    }

    /**
     * @param $id
     */
    public function removeById($id)
    {
        $this->pdo->query("DELETE FROM book WHERE id = {$id}");
    }


}