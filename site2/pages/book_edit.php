<?php

//ФОРМА ДЛЯ ДОБАВЛЕНИЯ И ДЛЯ РЕДАКТИРОВАНИЯ

require 'models/book.php';

$id=get('id');



if($id===null)
{
    //вставляем новую книгу
    echo 'new';
    $book=array('id'=>null,'title'=>null, 'price'=>null, 'description'=>null, 'is_active'=>null, 'style_id'=>null);
}
else
{
    //редактируем действующую
    echo 'edit #'.$id;

    $book=findBookById($id);
}
$styles=getStyles();

if(requestIsPost()){

   if(post('id')==''){

        // insert
       if(post('is_active')=='on'){
           $is_act=1;

       }else $is_act=0;

        $styleId=getStyleId(post('styles'));

       $book=array('title'=>post('title'), 'price'=>post('price'), 'description'=>post('description'), 'is_active'=>$is_act, 'style_id'=>$styleId['id']);

      //dd($book);
      //die;
         $res=insertBook($book);
    if ($res===false){
        setFlash('Error');
        redirect('/index.php?page=books');
    }
        setFlash('Insert ok');
        redirect('/index.php?page=books');
    }
    else{
        //update
        if(post('is_active')=='on'){
            $is_act=1;

        }else $is_act=0;
        $styleId=getStyleId(post('styles'));
        $book=array('title'=>post('title'), 'price'=>post('price'), 'description'=>post('description'), 'is_active'=>$is_act, 'style_id'=>$styleId['id']);
//       dd($book);
//        var_dump(post('id')) ;
//       die;
        $res=updateBook($book, (int)post('id'));

        if ($res===false){
            setFlash('Error');
            redirect('/index.php?page=books');
        }
        setFlash('Edit ok');
        redirect('/index.php?page=books');

}

}

?>

<form method="post">
    <input type="hidden" name="id" value="<?=$book['id']!==null?$book['id']:''?>">

    Title: <input type="text" name="title" class="form-control" value="<?=$book['title']?>"> <br>
    Price: <input type="text" name="price" class="form-control" value="<?=$book['price']?>"> <br>
    Description: <textarea name="description" id="" cols="30" rows="5" class="form-control" value=""><?=$book['description']?></textarea><br>
    Style: <select name='styles' size="1" class="form-control">
        <?php foreach ($styles as $style):?>
            <option><?=$style['name']?></option>
        <?php endforeach;?>
    </select>
    <br>
    Is active: <input type="checkbox" name="is_active" class="checkbox" <?= $book['is_active']?'checked':''?>><br><br>
    <button class="btn btn-default" type="submit" name="submit">GO</button>
</form>


