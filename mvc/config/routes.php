<?php
use Library\Route;

//TODO переделать через yml
//когда require этот файл - функция вервнет то, что тут создаем

// подстановка допустимого значения в id - регулярное выражение
// .- любое значение
// .+- любое значение и больше 1 символа
// [abc] 'a' 'b' 'c' - любой символ и этих
//[a-zA-Z] - весь алфавит
// [0-9] или /d - любое число
//[^0-9] - все кроме этих символов
//[0-9]+ - не пустая строка содержащая только цифры
//[0-9]* - пустая или строка содержащая только цифры
//[1-9][0-9]+ - двузначное и больше число
//[1-9][0-9]* - щднозначное и больше число
//[1-9]{10} - квантификатор  длина строки 10 {10, 30} - от 10 до 30, ? - 0 или 1 (/books/?) - это значит слэш может быть или не быть
//^[1-9]$ - где в тексте искать ^ - текст должен начинаться с этого выражения  - $ - длолжен заканчиваться
return  array(
    // site routes
    'default' => new Route('/', 'Site', 'index'),
    'index' => new Route('/index.php', 'Site', 'index'),
    'books_list' => new Route('/books/?', 'Book', 'index'),
    'book_page' => new Route('/book-{id}\.html', 'Book', 'show', array('id' => '[0-9]+') ),
    'contact_us' => new Route('/contact-us/?', 'Site', 'contact'),
    'login' => new Route('/login/?', 'Security', 'login'),
    'logout' => new Route('/logout/?', 'Security', 'logout'),
    'cart_list' => new Route('/cart', 'Cart', 'showList'),
    'cart_add' => new Route('/cart/add/{id}', 'Cart', 'add', array('id' => '[0-9]+')),
    // admin routes
    'admin_default' => new Route('/admin/?', 'Admin\\Default', 'index'),
    'admin_books' => new Route('/admin/books/?', 'Admin\\Book', 'index'),
    'admin_book_edit' => new Route('/admin/books/edit/{id}', 'Admin\\Book', 'edit', array('id' => '[0-9]+')),
    'admin_book_delete' => new Route('/admin/books/delete/{id}', 'Admin\\Book', 'delete', array('id' => '[0-9]+')),
    'admin_book_add' => new Route('/admin/books/edit/?', 'Admin\\Book', 'add'),
    'admin_styles' => new Route('/admin/styles/?', 'Admin\\Style', 'index'),
    'admin_style_edit' => new Route('/admin/styles/edit/{id}', 'Admin\\Style', 'edit', array('id' => '[0-9]+')),

    // api TODO 1. add methods 2. когда роут не найден и в url присутствует /api - выкинуть исключение которое созвучно с url (в этом случае ApiException)
    'api_save_feedback' => new Route('/api/feedback', 'API\\Site', 'saveFeedback'),
    'api_save_cart' => new Route('/api/cart/save', 'API\\Cart', 'save'),
    'api_books_list' => new Route('/api/books', 'API\\Book', 'index'),
    'api_books_item' => new Route('/api/books{id}', 'API\\Book', 'item',array('id' => '[0-9]+')),
    'api_books_create' => new Route('/api/books', 'API\\Book', 'create'),
    'api_books_update' => new Route('/api/books{id}', 'API\\Book', 'update',array('id' => '[0-9]+')),
    'api_books_delete' => new Route('/api/books/delete/{id}', 'API\\Book', 'delete',array('id' => '[0-9]+'))
);