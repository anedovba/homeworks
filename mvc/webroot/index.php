<?php

error_reporting(E_ALL);

use Library\Config;
use Library\Container;
use Library\RepositoryManager;
use Library\Request;
use Library\Controller;
use Library\Session;
use Library\Router;
use Library\Route;
use Library\DbConnection;
use Library\MetaHelper;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Yaml\Yaml;
use Controller\ErrorController;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',  __DIR__.DS. '..'.DS );
define('SRC_DIR', ROOT . 'src' . DS);
define('VIEW_DIR', SRC_DIR.'View'.DS);
define('LIB_DIR', SRC_DIR.'Library'.DS);
define('CONFIG_DIR', ROOT . 'config' . DS);
define('VENDOR_DIR', ROOT . 'vendor' . DS);
define('LOG_DIR', ROOT . 'logs' . DS);



//добавили файл для актоматической загрузки любого файла, класса из установленных продуктов через composer
require VENDOR_DIR.'autoload.php';

//TODO: autoload all classes via composer DONE

//автозагрузка классов
//spl_autoload_register( function ($className){
//    $file=SRC_DIR.str_replace('\\', DS, $className).'.php';
//    if(!file_exists($file)){
//        throw new \Exception("{$file} not found", 500);
//    }
//    require $file;
//});
try{
    //TODO: Session = new Session() в конструкторе Request() и сделать свойство privat $session в классе Request а в контроллерах будем обращаться Request->getSession...
    Session::start();

    //todo: move conf to separate file DONE
//    Config::set('db_user', 'root');
//    Config::set('db_pass', '');
//    Config::set('db_name', 'mvc_group_1009');
//    Config::set('db_host', 'localhost');

    $config=new Config();//TODO - пробежаться по всем файлам xml в папке config и распарсить privat function (file) $config->category()->value(), $config->db()->user(),
    //TODO реализовать чтение файлов yml

    $values=Yaml::parse(file_get_contents(CONFIG_DIR.'main.yml'));
    //dump($values);
    $request = new Request();

//    $dsn = 'mysql: host=' . Config::get('db_host') . '; dbname='. Config::get('db_name');
    //вынесли в класс
//    $dsn = 'mysql: host=' . $config->dbhost . '; dbname='. $config->dbname;
////    $pdo=new \PDO($dsn, Config::get('db_user'), Config::get('db_pass'));
//    $pdo = new \PDO($dsn, $config->dbuser, $config->dbpass);
//    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo = (new DbConnection($config))->getPDO();
    $repositoryManager=(new RepositoryManager())
        ->setPDO($pdo);

    // todo: fix!!!new Router($config)
    //в конструкторе делаем require файла, в класе роутер функционал который сопостовляет контролеры и экшены
    $router = new Router(CONFIG_DIR . 'routes.php');
    $metaHelper=new MetaHelper($config);

    // Create the logger
    $logger = new Logger('default_logger');
// Now add some handlers
    $logger->pushHandler(new StreamHandler(LOG_DIR.'log.txt', Logger::DEBUG));


    //в контейнер складываем все объекты которые необходимы для работы и которые не надо будет создавать много раз
    $container =new Container();
    //распарсенные файлы xml из сonfig
    $container->set('config', $config);

    // соединение с базой
    $container->set('database_connection', $pdo);
    //
    $container->set('repository_manager', $repositoryManager);
    //файл с массивом адресной строки
    $container->set('router', $router);
    //title и description
    $container->set('meta_helper', $metaHelper);
    $container->set('logger', $logger);//опрокидываем в контейнер и в контроллере можно использовать например в security контроллере

    $router->match($request);//перебор всех адресов на поиск совпадения

    $route = $router->getCurrentRoute();//вытаскиваем название текущий роутер контроллера и название действия
// определяем название контроллера и название действия
    $controller = 'Controller\\' . $route->controller . 'Controller';
    $action = $route->action . 'Action';

//    $request=new Request();
//если route не задан, то по умолчанию он site/index
//    $route=$request->get('route', 'site/index');
//    if(!stripos($route,'/')){
//        throw new \Exception('Page not found',404);
//    }
//    $route=explode('/', $route);
// TODO: done  проверка не пустые ли части контроллера и действия

//    if($route[0]==='' or $route[1]===''or !isset($route[1]) ){
//        throw new \Exception('Page not found',404);
//    }

//вытаскиваем название namespace+класса контроллера и метод действия который должен будет отобразить страницу на экране
//    $controller='Controller\\'.ucfirst($route[0]).'Controller';
//    $action=$route[1].'Action';
//для того что б проверялся и наличие метода с правильным названием
    $controller = new $controller();
    $controller->setContainer($container);
    // вытаскиваем все запросы
//проверяем существует ли метод в классе
    if(!method_exists($controller,$action)){
        throw new \Exception('Page not found',404);
    }
//вызываем действие но никто не гарантирует что оно есть у нас
    $content=$controller->$action($request);

} catch (\Exception $e){
  //$content=$e->getMessage();
//    $content=Controller::renderError($e->getMessage(), $e->getCode());
    $controller=new ErrorController();
    $controller->setContainer($container);
    $content=$controller->errorAction($request,$e);
}

echo $content;


//require VIEW_DIR.'default_layout.phtml'; // переносим в контроллер что б вначале отрисовывалась середина во время рендера

