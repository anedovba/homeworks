<?php
namespace Model\Repository;

use Library\EntityRepository;
use Model\Advert;
use Model\Category;


class CssRepository extends EntityRepository
{


    public function find(){
        $sth=$this->pdo->query("select * from css");
        $colors=[];
        while ($row=$sth->fetch(\PDO::FETCH_ASSOC)){
            $colors[]=$row['background-color'];
            $colors[]=$row['nav-color'];
        }
        return $colors;

    }
//
    //    public function save(Advert $advert, $table=null)
    //    {
    //        $class=explode('\\',get_class($advert));
    //
    //        $class=end($class);
    //
    //        if($table==null){
    //            $table=strtolower($class);
    //        }
    //
    //        if ($advert->getId()== ''){
    //            $query="insert INTO {$table} (id, name, price, company) VALUES (:id, :name, :price, :company)";
    //            $sth=$this->pdo->prepare($query);
    //            $sth->execute(array(
    //                'id'=>$advert->getId(),
    //                'name'=>$advert->getName(),
    //                'price'=>$advert->getPrice(),
    //                'company'=>$advert->getCompany()));
    //        }
    //        else{
    //
    //        $query="update {$table} set name=:name, price=:price, company=:company where id=:id";
    //            $sth=$this->pdo->prepare($query);
    //            $sth->execute(array(
    //                'name'=>$advert->getName(),
    //                'price'=>$advert->getPrice(),
    //                'company'=>$advert->getCompany(),
    //                'id'=>$advert->getId()));
    //        }
    //    }
    //
         public function change($color){
             $this->pdo->query("UPDATE css SET `background-color`= '$color'");
         }
    public function changeNav($color){
        $this->pdo->query("UPDATE css SET `nav-color`= '$color'");
    }
}