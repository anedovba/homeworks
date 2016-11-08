<?php
function findAllBooks(array $sorting=array('id'=>'ASC'))
{
    global $link;
    $sql="SELECT * FROM book";
    $res=mysqli_query($link, $sql);

    $books=array();

    while( $row=mysqli_fetch_assoc($res)){
        $books[]=$row;
    }

    return $books;

}

/**
 * @param $id
 * @return array|null
 */
function findBookById($id)
{
    global $link;
    $id=(int)$id;
    $sql="SELECT * FROM book WHERE id={$id}";
    $res=mysqli_query($link, $sql);
    return mysqli_fetch_assoc($res);
}

/**
 * @param $id
 * @return bool|mysqli_result
 */
function removeBookById($id){
    global $link;
    $id=(int)$id;
    $sql="DELETE FROM book WHERE id='$id'";
    $res=mysqli_query($link, $sql);

    return $res;
}

/**
 * @param $book
 * @return bool|mysqli_result
 */
function insertBook($book){
    global $link;

    $sql="INSERT INTO book (`title`, `description`, `price`, `is_active`) VALUES ({$book["title"]}, {$book['description']}, {$book['price']}, {$book['is_active']});";
    $res=mysqli_query($link, $sql);

    return $res;
}

/**
 * @param $book
 * @param $id
 * @return bool|mysqli_result
 */
function updateBook($book, $id){
    global $link;
    $t=$book["title"];
    $b=$book["description"];
    $p=$book["price"];
    $a=$book["is_active"];
   $sql="UPDATE book SET title='$t', description='$b', price='$p', is_active='$a' WHERE id = '$id'";
    $res=mysqli_query($link, $sql);

    return $res;
}