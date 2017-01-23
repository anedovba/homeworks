<?php
namespace Controller\API;

use Library\Controller;

use Library\FormatterFactory;
use Library\Request;
use Library\Response;
use Model\Feedback;


class SiteController extends Controller
{

    /**
          *
     * @param Request $request
     * @return string
     *
     *
     * аннотации - аналог Symfony
     * @Route()
     * @Methods[POST]
     *
     */
    public function saveFeedbackAction(Request  $request)
    {
        $format = $request->get('_format', 'json');
        $formatter = FormatterFactory::create($format);
        $repos=$this->container->get('repository_manager')->getRepository('Feedback');
        $feedback=(new Feedback())
            ->setName($request->post('username'))
            ->setEmail($request->post('email'))
            ->setMessage($request->post('message'))
            ->setIpAddress($request->getIpAddress())
        ;
        try{
            $repos->save($feedback);
            $code=200;
            $message="Saved";
        }catch (\PDOException $e){
            $message=$e->getMessage();
            $code=500;
        }

//        $books=$repos->findAll($hydrateArray=true);
        $response = new Response($code, $message, $formatter);
        return $response;
    }

}