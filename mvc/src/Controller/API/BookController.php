<?php
namespace Controller\API;

use Library\Controller;

use Library\FormatterFactory;
use Library\Request;
use Library\Response;


class BookController extends Controller 
{

    /**
     *TODO in routes - add new param - method
     * GET /api/books/534 => i get book #534
     * DELETE /api/books/534 => i delete it
     *
     * @param Request $request
     * @return string
     *
     *
     * аннотации - аналог Symfony
     * @Route()
     * @Methods[PUT, POST,  GET]
     *
     */
    public function indexAction(Request $request)
    {
        /*
         * move to controller
         * */
//        //ReflectionСlass - объект этого класса считывает всю инфо с класса, даже комментарии
//        $reflection=new \ReflectionClass(\Controller\API\BookController::class);//::class - возврат строчки, котороая соответствует названию класса
//        $method=$reflection->getMethod(__FUNCTION__);//получаем все что есть в текущем методе
//
//        $doc=$method->getDocComment();//получаем комментарии. далее поиском регулярки ищем методы
//        preg_match('#@Methods\[([A-Z,\s]+)\]#', $doc, $matches);//поиск в $doc и запись совпадений в $matches
//        array_shift($matches);//убираем первый элемент @Methods[GET, POST]
//
//        dump($doc, explode(",", str_replace(" ", '', $matches[0])));
//        die;
        $httpMethod=$request->getMethod();
        $format = $request->get('_format', 'json');
        $formatter = FormatterFactory::create($format);
        $allowedMethods=$this->getAllowedMethods(__FUNCTION__);//TODO getAllowedMethods вытянуть с config routes
        if (!in_array($httpMethod,$allowedMethods))
        {
            $response = new Response(405, 'Method not allowed', $formatter);
            return $response;
        }

        $repos=$this->container->get('repository_manager')->getRepository('Book');
        $books=$repos->findAll($hydrateArray=true);
        $response = new Response(200, $books, $formatter);
//        $response=
//            [
//            'status'=>'success',
//            'data'=>$books,
//            'count'=>count($books)
//            ];
//        header('Content-Type: application/json');
//        return json_encode($response);
        return $response;
    }

    //TODO методы для получения конкретной книжки по ID, для внесения изменений в книжку, для удаления и вставления новой
    public function showAction(Request $request)
    {
        //TODO
    }

}