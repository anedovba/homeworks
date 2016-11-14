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
    $t=$book["title"];
    $b=$book["description"];
    $p=$book["price"];
    $a=$book["is_active"];
    $s=$book["style_id"];

    $sql="INSERT INTO book (`title`, `description`, `price`, `is_active`, `style_id`) VALUES ('$t', '$b', '$p', '$a', '$s');";
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
    $s=$book["style_id"];
    $sql="UPDATE book SET title='$t', description='$b', price='$p', is_active='$a', style_id='$s' WHERE id = '$id'";
    $res=mysqli_query($link, $sql);

    return $res;
}

function getStyles(){
    global $link;
    $sql="SELECT * FROM style";
    $res=mysqli_query($link, $sql);
    $styles=array();

    while( $row=mysqli_fetch_assoc($res)){
        $styles[]=$row;
    }

    return $styles;
}

function getStyleId($name){
    global $link;
    $sql="SELECT id FROM style WHERE name='$name'";
    $res=mysqli_query($link, $sql);
    return mysqli_fetch_assoc($res);
}