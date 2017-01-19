<?php
namespace Model\Repository;

use Library\EntityRepository;
use Model\Author;


class AuthorRepository extends EntityRepository
{

    public function findAll(){

        $sth=$this->pdo->query('select * from author');

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
                $author=(new Author())
                ->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setLastName($row['last_name'])
                ->setDateBirth($row['date_birth'])
                ->setDateDeath($row['date_death'])

            ;

            $authors[]=$author;
        }
        return $authors;
    }

    public function findAuthors($id){
        $sth=$this->pdo->query("select * from author where id={$id}");


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

    public function save(Author $author, $table=null)
    {//save to db if insert else update
        $class=explode('\\',get_class($author));

        $class=end($class);
        if($table==null){
            $table=strtolower($class);
        }

        $query="update {$table} set first_name=:first_name, last_name=:last_name, date_birth=:date_birth, date_death=:date_death where id=:id";
        $sth=$this->pdo->prepare($query);

        $sth->execute(array(
            'first_name'=>$author->getFirstName(),
            'last_name'=>$author->getLastName(),
            'date_birth'=>$author->getDateBirth(),
            'date_death'=>$author->getDateDeath(),
            'id'=>$author->getId()
        ));
    }
}