<?php
namespace Model\Repository;

//use Library\DbConnection;
use Library\EntityRepository;
use Model\User;


class UserRepository extends EntityRepository
{
    public function find($email, $password){
        $sth = $this->pdo->prepare('select * from user where email = :email and password = :password');
        $sth->execute(compact('email', 'password'));
        $user = $sth->fetch(\PDO::FETCH_ASSOC);

        if ($user){
            $user=(new User())->setEmail($user['email'])->setId($user['id']);
        }
        return $user;
    }


}