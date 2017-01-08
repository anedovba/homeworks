<?php
namespace Library;
use Library\Exception\ParameterNotFoundException;
class Config
{
    // TODO скандир - проверяем расширение xml делаем приватный метод foreach - по всем файлам перед этим убираем . и ..
    //TODO тоже самое тольк с yml файлами

    public function __construct()
    {
        $file = CONFIG_DIR . 'db.xml';
        //берет файл и превращает в объект с свойствами и их значениями согласно тегам
        $xmlObject = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOWARNING);
        //если файл не xml - ошибка
        if (!$xmlObject) {
            throw new \Exception('Config file not found');
        }

        //создание метода на лету
        foreach ($xmlObject as  $key => $value) {
            $this->$key = (string)$value;
        }
    }

    //обрабатіваем візов несуществующего свойства
    public function __get($name)
    {
        throw new ParameterNotFoundException();
    }

//    private static $elements = array();
//    public static function set($key, $value)
//    {
//        self::$elements[$key] = $value;
//    }
//    public static function get($key)
//    {
//        if (isset(self::$elements[$key])) {
//            return self::$elements[$key];
//        }
//        return null;
//    }
}