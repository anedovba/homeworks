$(document).ready(function(){

    function advert () {
        var originSize;
        var id;
        var originWeight;
        var originColor;

        $('.well').hover(function() {
                id=$(this).attr('id').replace('link-','');
                originWeight= $('#ad-'+id).css('font-weight');
            var weight=originWeight*0.9;
                originSize=$('#ad-'+id).css('font-size').replace('px','');
                var size=originSize*1.9;
                originColor=$('#ad-'+id).css('color');
                $('#ad-'+id).css('font-size', size+'px').css('font-weight', weight).css({"color":"violet"});
            },
            function() {
                $('#ad-'+id).css('font-size', originSize+'px').css('font-weight', originWeight).css({"color":originColor});

            });
$(".well").tooltip();


    };

    advert();


        // считаем и записваем читающих

        var readNow = Math.floor((Math.random() * 5)+1);
        var readTotal = parseInt($('#total-read').text());
        $('#reading-now').text(readNow);

        function saveViews() {

            readTotal += readNow;
            var id=$("#post-id").text();
            var udateData=String(readTotal)+"_"+id;
            $.get('/post/viewupdate/'+udateData);
        }

        setInterval(function(){
            $('#total-read').text(readTotal);
            readNow = Math.floor((Math.random() * 5)+1);
            $('#reading-now').text(readNow);
            saveViews();
        }, 3000);

//обработка закрытия окна
    function Unloader(){
        var o = this;
        this.unload = function(evt)
        {
            var message = "Вы уверены, что хотите закрыть страницу?";
            if (typeof evt == "undefined") {
               evt = window.event;
            }
            if (evt) {
                evt.returnValue = message;
            }
            return message;
        }
        this.resetUnload = function()
        {
            $(window).off('beforeunload', o.unload);
            setTimeout(function(){
               $(window).on('beforeunload', o.unload);
                }, 1000);
             }
        this.init = function()
        {
            $(window).on('beforeunload', o.unload);
            $('a').on('click', o.resetUnload);
            $(document).on('submit', 'form', o.resetUnload);
            $(document).on('keydown', function(event){
                if((event.ctrlKey && event.keyCode == 116) || event.keyCode == 116){
                    o.resetUnload();
                }
            });
        }
        this.init();
    }
    $(function(){
        if(typeof window.obUnloader != 'object')
        {
            window.obUnloader = new Unloader();
        }
    })

        //карусель

    $("#myCarousel2").carousel('cycle');

    // Осуществляет переход на предыдущий слайд
    $(".prev-slide").click(function(){
        $("#myCarousel2").carousel('prev');
    });
    // Осуществляет переход на следующий слайд
    $(".next-slide").click(function(){
        $("#myCarousel2").carousel('next');
    });



    // var cartCount;
    // // обрабатываем клик на кнопку  Add to cart
    // $('a[id^=add-to-cart-btn-]').click(function (e) {
    //     e.preventDefault();
    //     var id=$(this).attr('id').replace('add-to-cart-btn-','');
    //     $.get('/cart/add/'+id);
    //     cartCount=parseInt($('#cart-count').text())+1;
    //     $('#cart-count').text(cartCount);
    // });
    //
    //
    // //cart calculation
    // function calculate() {
    //     var id;//id книги
    //     var amount; // кол-во книг
    //     var price; // цена
    //     var total; // общая цена книг по 1 id
    //     var totalTotal=0; // вся сума товара в корзине
    //     var cartObject={};
    //     cartCount=0;
    //     //выбираем все инпуты с корзины с количеством книг
    //     // var inputs = $('#cart-list input[type=number]').each(function (item) {
    //     //     console.log($(this).val());
    //     // });
    //
    //     //второй вариант - input начинается с cart-item
    //     var inputs = $('input[id^=cart-item]').each(function () {
    //         id=$(this).attr("id").replace('cart-item-','');
    //         amount=parseInt($(this).val());
    //         price=parseFloat($('#price-'+id).text());
    //         total=price*amount;
    //         $('#result-'+id).text(total.toFixed(2));
    //         totalTotal+=total;
    //         cartCount +=amount;
    //         //сохраняем значение id книги и их количество
    //         cartObject[id]=amount;
    //
    //
    //     });
    //     $('#total').text(parseFloat(totalTotal.toFixed(2)));
    //
    //     return cartObject;
    // }
    //
    // calculate();
    // $('#save-cart').click(function () {
    //     $('#cart-count').text(cartCount);
    //     var cartJson=JSON.stringify(calculate());
    //     //отправляем пост запросом в сохранение корзины
    //     $.post('/api/cart/save', {'cart': cartJson})
    //         .done()
    //         .fail()
    //         .always(function (response) {
    //             console.log(response);
    //         })
    //     ;
    // });
    // $('[id^=cart-item]').on('input',function () {
    //     calculate();
    //
    // });
    //
    //
    // $('.delete').click(function(e){
    //     e.preventDefault();
    //     if(!confirm('Are you sure?')){
    //         e.preventDefault();
    //         return;
    //     }
    //     var deleteData=$(this).parent().parent().parent().first().children('td.bookId').text();
    //     var hideElement=$(this).parent().parent().parent().first();
    //
    //     $.get('/admin/books/delete/'+deleteData)
    //         .done(function () {
    //             hideElement.fadeOut(500);
    //         })
    // });
    // $('.title').on('click', function (){
    //
    //     // $('.description').toggle(500);
    //     $(this).parent().next().children().toggle(500);
    // });

    function validateContactForm() {
        // var username = $('#username').val();
        // var email = $('#email').val();
        var message = $('#message').val();

        var res = /*username != '' && email != '' &&*/ message != '';

        return res;
    }
    function validateAnswerForm(id) {

        var message = $('#message-answer-'+id).val();

        var res =  message != '';

        return res;
    }

    function validateChangeForm(id) {

        var message = $('#message-change-'+id).val();

        var res =  message != '';
        console.log(id);


        return res;
    }

    $(document).on('click', '.alert', function() {
        $(this).fadeOut();

    });

    $('.like').click(function (e) {
            e.preventDefault();
            var id=$(this).attr('id').replace('comment-like-','');
            $.get('/post/like/'+id);
        var mark=$('#mark-'+id).text();
        mark=Number(mark)+1;
        $('#mark-'+id).text(mark);

        $(this).fadeOut(1000);
    });
    $('.dislike').click(function (e) {
        e.preventDefault();
        var id=$(this).attr('id').replace('comment-dislike-','');

        var mark=$('#mark-'+id).text();
        if(Number(mark)>0){
        mark=Number(mark)-1;
        $.get('/post/dislike/'+id);
        }
        $('#mark-'+id).text(mark);

        $(this).fadeOut(1000);
    });
    $('.change').click(function () {
        var id=$(this).attr('id').replace('btn-change-','');
        $('#change-'+id).fadeIn();
    });

    $('form[id^=change-form-]').submit(function (e) {
        e.preventDefault();
        var id=$(this).attr('id').replace('change-form-','');
        if (!validateChangeForm(id)) {
            $('#alert-box-'+id).html('<div class="alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Заполните комментарий</div>');
            e.preventDefault();
            return;
        }
        var formData, postParameters = {};
        formData=$(this).serializeArray();
        console.log(formData);
        var obj;
        for (key in formData){
            obj=formData[key];
            postParameters[obj.name]=obj.value;
        }
        $.post('/post/comment/id', postParameters)
            .done(function () {
                //пропадает форма
                $('#change-form-'+id).fadeOut(function () {
                    $('#main-comment-'+id).text($('#message-change-'+id).val());
                    $('#change-form-'+id).after('Ваш комментирий изменен');

                });
            })
            .fail(function () {
                $('#change-form-'+id).fadeOut(function () {
                    $('#change-form-'+id).after('Error');
                });
            })
            .always(function (response) {

            })
        ;

    });

    $('.answer').click(function () {
        var id=$(this).attr('id').replace('btn-','');
        console.log(id);
        $('#answer-'+id).fadeIn();
    })


    $('form[id^=answer-form-]').submit(function (e) {
        e.preventDefault();
        var id=$(this).attr('id').replace('answer-form-','');
        if (!validateAnswerForm(id)) {
            $('#alert-box-'+id).html('<div class="alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Заполните комментарий</div>');
            e.preventDefault();
            return;
        }

        var formData, postParameters = {};
        formData=$(this).serializeArray();
        console.log(formData);
        var obj;
        for (key in formData){
            obj=formData[key];
            postParameters[obj.name]=obj.value;
        }
        $.post('/post/comment', postParameters)
            .done(function () {
                //пропадает форма
                $('#answer-form-'+id).fadeOut(function () {
                    $('#answer-form-'+id).after('Ваш комментирий сохранен и в ближайшее время появится под новостью');
                });
            })
            .fail(function () {
                $('#answer-form-'+id).fadeOut(function () {
                    $('#answer-form-'+id).after('Error');
                });
            })
            .always(function (response) {

            })
        ;
    });

    $('#comment-form').submit(function(e) {

        e.preventDefault();
        if (!validateContactForm()) {
            $('.alert-box').html('<div class="alert alert-danger alert-dismissable"><button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Заполните комментарий</div>');
                e.preventDefault();
            return;
        }

        var formData, postParameters = {};
        formData=$(this).serializeArray();
        console.log(formData);
        var obj;
        for (key in formData){
            obj=formData[key];
            postParameters[obj.name]=obj.value;
        }
        $('#spinner-load').show();
        $.post('/post/comment', postParameters)
            .done(function () {
                //пропадает форма
                $('#comment-form').fadeOut(function () {
                    $('#comment-form').after('Ваш комментирий сохранен и в ближайшее время появится под новостью');
                });

            })
            .fail(function () {
                $('#comment-form').fadeOut(function () {
                    $('#comment-form').after('Error');
                });
            })
            .always(function (response) {

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

// модальное окно подписка на повости
    var delay_popup = 15000;

        var hideTheModal = $.cookie('hideTheModal');
        // если cookie не установлено...
        if(hideTheModal == null){

            setTimeout(function(){
                // вызвать модальное окно
                $('#myModal').modal("show");
                // если кнопка "Закрыть" нажата
                $('.modal').click(function(){
                    // добавить cookie
                    $.cookie('hideTheModal', { expires: 30 });
                });
            }, delay_popup);
        }



    // $("#search").keyup(function(e){
        //     var search = $("#search").val();
        //     console.log(search);
        //
        //
        //     $.post('/tag/show', {"search": search})
        //         .done()
        //         .fail()
        //
        //         .always(function (response) {
        //             console.log(response);
        //         })
        //         // .always(
        //         //     function (response) {
        //         //         cosole.log(response);
        //         //     // $("#resSearch").html(response);
        //         // }
        //         // )
        //     ;
        //
        // });


});



