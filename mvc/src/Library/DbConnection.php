<?php
namespace Library;
class DbConnection
{
//    private static $instance;
//    /**
//     * @var PDO
//     */
//    private $pdo;
//    private function __construct()
//    {
//        // like:  mysql: host=localhost; dbname=mvc1102
//        $dsn = 'mysql: host=' . Config::get('db_host') . '; dbname='. Config::get('db_name');
//        $this->pdo = new \PDO($dsn, Config::get('db_user'), Config::get('db_pass'));
//        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
//    }
//    private function __clone(){}
//    private function __wakeup(){}
//    public static function getInstance()
//    {
//        if (self::$instance === null) {
//            self::$instance = new DbConnection();
//        }
//        return self::$instance;
//    }

    private $pdo;

    public function __construct(Config $config)
    {
        $dsn = 'mysql: host=' . $config->dbhost . '; dbname='. $config->dbname;
        $this->pdo = new \PDO($dsn, $config->dbuser, $config->dbpass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }
}