<?php
namespace Model\Repository;

use Library\EntityRepository;

class MenuRepository extends EntityRepository
{


    public function find(){
        $sth=$this->pdo->query("select * from menu");
        $items=[];
        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            if(empty($items[$row['parent_id']])) {
                $items[$row['parent_id']]=[];
            }
            $items[$row['parent_id']][] = $row;
        }
        return $items;
    }


}