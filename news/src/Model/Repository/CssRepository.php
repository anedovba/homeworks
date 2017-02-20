<?php
namespace Model\Repository;

use Library\EntityRepository;
use Model\Advert;
use Model\Category;


class CssRepository extends EntityRepository
{

//    private function createAdvert($id, $name, $price, $company)
//    {
//        $advert=(new Advert())
//            ->setId($id)
//            ->setName($name)
//            ->setPrice($price)
//            ->setCompany($company)
//        ;
//        return $advert;
//    }


    public function find(){
        $sth=$this->pdo->query("select * from css");


        $row=$sth->fetch(\PDO::FETCH_ASSOC);

        if(!$row)
        {
            throw new \Exception('not found');
        }

        if ($row){
            $bcolor=$row['background-color'];
        }
        return $bcolor;
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
}