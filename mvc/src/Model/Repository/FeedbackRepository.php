<?php
namespace Model\Repository;

//use Library\DbConnection;
use Library\EntityRepository;

class FeedbackRepository extends EntityRepository
{
     /**
     * @param $object
     */
    public function save($object, $table=null)
    {//save to db if insert else update
        $class=explode('\\',get_class($object));
        $class=end($class);
        if($table==null){
        $table=strtolower($class);
        }
        $query="insert into {$table} (name, email, message, ip_address) values (:name, :email, :message, :ip_address)";
        $sth=$this->pdo->prepare($query);
        $sth->execute(array(
            'name'=>$object->getName(),
            'email'=>$object->getEmail(),
            'message'=>$object->getMessage(),
            'ip_address'=>$object->getIpAddress()
            ));
    }
}