<?php

//// .gitignore
//
//echo 1;
//// two
//echo 2;
//
//echo 3;
//echo 'some new stuff';
//echo 4;
//
//echo 5;

// null, bool, int, float, string
// array
echo '<pre>';
$fruits = array(
    'apples' => 2,
    'oranges' => 32,
    'bananas' => 343,
    'pineapple' => 0
); // < 5.4
//var_dump($fruits);
//echo $fruits['apples'];

$book1 = array(
    'title' => 'Carrie',
    'author' => 'King',
    'price' => 2134.50
);

$book2 = array(
    'title' => 'Idiot',
    'author' => 'Dostoevskii',
    'price' => 546454.50
);

$book3 = array(
    'title' => 'Kobzar',
    'author' => 'Shevchenko',
    'price' => 235543.50
);

echo isset($book2['author']) ? $book2['author'] : null;

$books = array($book1, $book2, $book3);
$books[] = 'new stuff';

print_r($books);
















