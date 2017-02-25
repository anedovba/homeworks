<?php
namespace Controller;

use Library\Controller;
use Library\Pagination\Pagination;
use Library\Request;
use Library\Session;
use Model\Comment;
use Model\Form\CommentForm;


class SiteController extends Controller {

    const PER_PAGE = 5;

    public function indexAction(Request $request)
    {
        $repos=$this->container->get('repository_manager')->getRepository('Category');
        $categorys=$repos->findAll();
        $repos=$this->container->get('repository_manager')->getRepository('Comment');
        $topUsers=$repos->findTopUser();
        $topIds=$repos->findByTopComments();
        $repos=$this->container->get('repository_manager')->getRepository('User');
        $users=[];
        foreach ($topUsers as $topUser){
            $users[]=$repos->findById($topUser);
        }
        $repos=$this->container->get('repository_manager')->getRepository('Post');
        $topPosts=[];
        foreach ($topIds as $topId){
            $topPosts[]=$repos->find($topId);
        }
        $posts = $repos->findAll();
        $repos=$this->container->get('repository_manager')->getRepository('Css');
        $colors=$repos->find();
        $bcolor=$colors[0];
        $ncolor=$colors[1];

        $args=['categorys'=>$categorys, 'posts'=>$posts, 'topUsers'=>$users, 'topPosts'=>$topPosts, 'bcolor'=>$bcolor, 'ncolor'=>$ncolor];
//        dump($args);die;
        return $this->render('index.phtml', $args);


    }

    public function commentAction(Request $request){
        $id=$request->get('id');
        $repos=$this->container->get('repository_manager')->getRepository('User');
        $user=$repos->findById($id);
        $repos=$this->container->get('repository_manager')->getRepository('Comment');
        $page=(int)$request->get('page',1);
        if ($page < 1)
        {
            $page=1;
        }
        $count = $repos->countByUserId($id);
        $comments = $repos->findByUserIdByPage($id, $page, self::PER_PAGE);
        if (!$comments && $count) {
            $this->container->get('router')->redirect('/');
        }
        $pagination = new Pagination($count, self::PER_PAGE, $page);

        $args=['comments'=>$comments, 'user'=>$user, 'pagination'=>$pagination];

        return $this->render('comment.phtml', $args);
    }

    public function searchAction(Request $request)
    {
        $repos=$this->container->get('repository_manager')->getRepository('Category');
        $categorys=$repos->findAll();

        $repos=$this->container->get('repository_manager')->getRepository('Tag');

        $tagsAll = $repos->findAll();
        $tags='';
        foreach ($tagsAll as $tag){
            $tags.=$tag.', ';
        }
        $tags=explode(', ', $tags);
        $tags=array_unique($tags);
        foreach( $tags as $key => $val ){
            if( is_array($val) ){
                deleteItem($tags[$key], '');
            }elseif( $val==='' ){
                unset($tags[$key]);
            }
        }
//        dump($tags);
//        die;
        $args=['categorys'=>$categorys, 'tags'=>$tags];
        return $this->render('search.phtml', $args);

    }

}