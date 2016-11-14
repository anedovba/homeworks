<?php

require 'models/book.php';

$books=findAllBooks();//вытягиваем с базы все книги

//удаление
if(get('action')=='delete' && get('id') ){
    $res=removeBookById(get('id'));
    if ($res===false){
        setFlash('Error');
        redirect('/index.php?page=books');
    }
    setFlash('Removed book #'. get('id'));
    redirect('/index.php?page=books');
}
?>

<a href="/index.php?page=book_edit" class="btn btn-info">Add book</a>
<br>
<br>

<table class="table table-striped" >
   <thread>
       <tr class="bg-warning">
           <th>
               ID
           </th>
           <th>Title</th>
           <th>Price</th>
           <th>Actions</th>
       </tr>
   </thread>
<tbody>
<!--    вывод книг на страницу-->
    <?php foreach ($books as $book):?>
        <tr>
            <td><?= $book['id']?></td>
            <td><?= $book['title']?></td>
            <th scope="row"><?= $book['price']?></th>
            <td><a href="/index.php?page=book_edit&amp;id=<?= $book['id']?>">Edit</a>
                <a href="/index.php?page=books&amp;action=delete&amp;id=<?= $book['id']?>">Delete</a>
            </td>

        </tr>
    <?php endforeach;?>
</tbody>
</table>

<!--TODO вывести авторов