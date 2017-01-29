//TODO confirm на удалении DONE
//TODO по клику на тайтл показывать/скрывать дескрипшн DONE
//TODO валидация формы логина DONE
//TODO удалять книгу из админки аяксом DONE
// TODO подгружать книги jQuery - след страница - при этом прячем ее на пагинаторе
// TODO добавлять книги в корзину ajax при нажати  на кнопку Add to cart DONE
$(document).ready(function(){
    var cartCount;
    // обрабатываем клик на кнопку  Add to cart
    $('a[id^=add-to-cart-btn-]').click(function (e) {
        e.preventDefault();
        var id=$(this).attr('id').replace('add-to-cart-btn-','');
        $.get('/cart/add/'+id);
        cartCount=parseInt($('#cart-count').text())+1;
        $('#cart-count').text(cartCount);
    });


    //cart calculation
    function calculate() {
        var id;//id книги
        var amount; // кол-во книг
        var price; // цена
        var total; // общая цена книг по 1 id
        var totalTotal=0; // вся сума товара в корзине
        var cartObject={};
        cartCount=0;
        //выбираем все инпуты с корзины с количеством книг
        // var inputs = $('#cart-list input[type=number]').each(function (item) {
        //     console.log($(this).val());
        // });

        //второй вариант - input начинается с cart-item
        var inputs = $('input[id^=cart-item]').each(function () {
            id=$(this).attr("id").replace('cart-item-','');
            amount=parseInt($(this).val());
            price=parseFloat($('#price-'+id).text());
            total=price*amount;
            $('#result-'+id).text(total.toFixed(2));
            totalTotal+=total;
            cartCount +=amount;
            //сохраняем значение id книги и их количество
            cartObject[id]=amount;


        });
        $('#total').text(parseFloat(totalTotal.toFixed(2)));

        return cartObject;
    }

    calculate();
    $('#save-cart').click(function () {
        $('#cart-count').text(cartCount);
        var cartJson=JSON.stringify(calculate());
        //отправляем пост запросом в сохранение корзины
        $.post('/api/cart/save', {'cart': cartJson})
            .done()
            .fail()
            .always(function (response) {
                 console.log(response);
            })
        ;
    });
    $('[id^=cart-item]').on('input',function () {
        calculate();

    });


    $('.delete').click(function(e){
        e.preventDefault();
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return;
        }
    var deleteData=$(this).parent().parent().parent().first().children('td.bookId').text();
        var hideElement=$(this).parent().parent().parent().first();

        $.get('/admin/books/delete/'+deleteData)
            .done(function () {
                hideElement.fadeOut(500);
            })
    });
    $('.title').on('click', function (){

        // $('.description').toggle(500);
        $(this).parent().next().children().toggle(500);
    });

    function validateContactForm() {
        var username = $('#username').val();
        var email = $('#email').val();
        var message = $('#message').val();

        var res = username != '' && email != '' && message != '';

        return res;
    }

    $(document).on('click', '.alert', function() {
        $(this).fadeOut();

    });

    $('#contact-form').submit(function(e) {
        e.preventDefault();
        if (!validateContactForm()) {
            $('.alert-box').html('<div class="alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Invalid</div>');
            e.preventDefault();
            return;
        }

        //TODO спиннер добавить DONE
        var formData, postParameters = {};
        formData=$(this).serializeArray();
        console.log(formData);
        var obj;
        for (key in formData){
            obj=formData[key];
            postParameters[obj.name]=obj.value;
        }
        $('#spinner-load').show();
        $.post('/api/feedback', postParameters)
            .done(function () {
                //пропадает форма
            $('#contact-form').fadeOut(function () {
                $('#contact-form').after('Saved');
            });
            })
            .fail(function () {
                $('#contact-form').fadeOut(function () {
                    $('#contact-form').after('Error');
                });
            })
            .always(function (response) {
                //TODO убрать спиннер DONE
                $('#spinner-load').fadeOut(1000);
                
            })
        ;
        // console.log(postParameters);

    });

    function validateLoginForm() {
        var inputEmail = $('#inputEmail').val();
        var inputPassword = $('#inputPassword').val();
        var res = inputEmail != '' && inputPassword != '';

        return res;
    }

    $('#login-form').submit(function(e) {
        if (!validateLoginForm()) {
            $('.alert-box').html('<div class="alert alert-danger">Invalid</div>');
            e.preventDefault();
        }
    });

});

