<?php
namespace Model\Repository;

use Library\EntityRepository;
use Model\Style;


class StyleRepository extends EntityRepository
{

    public function findAll(){

        $sth=$this->pdo->query('select * from style');

        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            //TODO: Style DONE
            $style=(new Style())
                ->setId($row['id'])
                ->setName($row['name'])
            ;

            $styles[]=$style;
        }
        return $styles;
    }

    public function find($id){
        $sth=$this->pdo->query("select * from style where id={$id}");


        $data=$sth->fetch(\PDO::FETCH_ASSOC);

        if(!$data)
        {
            throw new \Exception('not found');
        }

        if ($data){
            $style=(new Style())
                ->setId($data['id'])
                ->setName($data['name']);
        }
        return $style;
    }

    public function save(Style $style, $table=null)
    {//save to db if insert else update
        $class=explode('\\',get_class($style));

        $class=end($class);
        if($table==null){
            $table=strtolower($class);
        }

        $query="update {$table} set name=:name where id=:id";
        $sth=$this->pdo->prepare($query);

        $sth->execute(array(
            'name'=>$style->getName(),
            'id'=>$style->getId()
        ));
    }
}