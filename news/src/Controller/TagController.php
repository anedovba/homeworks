<?php
namespace Controller;
use Library\Controller;
use Library\Request;
use Library\Response;

class TagController extends Controller
{

    public function indexAction(Request $request)
    {
        $repos=$this->container->get('repository_manager')->getRepository('Tag');

        $tag = $request->get('id');
        $tag=urldecode($tag);

        $posts = $repos->find($tag);

        $args=['posts'=>$posts, 'tag'=>$tag];
        return $this->render('index.phtml', $args);

    }

    public function showAction(Request $request)
    {
        $tags=[];
        $search='';
        if($request->post('search')){
            $search = $request->post('search');
        }
        if($search == ''){
            return  $tags[]="Начните вводить запрос";
        }
        $repos=$this->container->get('repository_manager')->getRepository('Tag');
        $tags=$repos->show($search);
        return $tags;
    }


}